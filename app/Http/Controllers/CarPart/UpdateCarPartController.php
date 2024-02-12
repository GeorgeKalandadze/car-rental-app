<?php

namespace App\Http\Controllers\CarPart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarPartRequest;
use App\Http\Resources\CarPartResource;
use App\Models\CarPart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UpdateCarPartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CarPartRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $carPart = CarPart::find($id);
            $carPart->update($data);

            if (isset($data['images'])) {
                $existingImages = $carPart->images;
                $imageIdsToDelete = collect($existingImages)->pluck('id')->diff(collect($data['images'])->pluck('id'));
                Image::whereIn('id', $imageIdsToDelete)->delete();
                foreach ($data['images'] as $index => $image) {
                    if ($image) {

                        $imageName = $carPart->id.'_'.time().'_'.$image->getClientOriginalName();
                        $imageUrl = $image->storeAs('public/images', $imageName);
                        $carPart->images()->create([
                            'url' => env('APP_URL').Storage::url($imageUrl),
                            'size' => $image->getSize(),
                            'type' => $image->getClientMimeType(),
                        ]);
                    }
                }
            }
            $carPart->load('images');

            return new CarPartResource($carPart);

        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred during the update process.'], 500);
        }

    }
}
