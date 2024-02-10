<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UpdateCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CarRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $car = Car::findOrFail($id);
            $car->update($data);

            if (isset($data['images'])) {
                $existingImages = $car->images;
                $imageIdsToDelete = collect($existingImages)->pluck('id')->diff(collect($data['images'])->pluck('id'));
                Image::whereIn('id', $imageIdsToDelete)->delete();
                foreach ($data['images'] as $index => $image) {
                    if ($image) {

                        $imageName = $car->id . '_' . time() . '_' . $image->getClientOriginalName();
                        $imageUrl = $image->storeAs('public/images', $imageName);
                        $car->images()->create([
                            'url' => env('APP_URL') . Storage::url($imageUrl),
                            'size' => $image->getSize(),
                            'type' => $image->getClientMimeType(),
                        ]);
                    }
                }
            }
            $car->load('images');

            return new CarResource($car);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred during the update process.'], 500);
        }
    }
}
