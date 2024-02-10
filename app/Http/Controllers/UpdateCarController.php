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

//            if (isset($data['images'])) {
//                $existingImages = $car->images;
//                $newImages = $data['images'];
//
//                foreach ($existingImages as $existingImage) {
//                    Storage::delete($existingImage->name);
//                    $existingImage->delete();
//                }
//
//                foreach ($newImages as $index => $image) {
//                    $imageName = $car->id . time() . $index . $image->getClientOriginalName();
//                    $image->storeAs('public/images', $imageName);
//
//                    Image::create([
//                        'car_id' => $car->id,
//                        'name' => env('APP_URL') . Storage::url('images/' . $imageName),
//                        'size' => $image->getSize(),
//                        'type' => $image->getMimeType(),
//                    ]);
//                }
//            }
//
//            $car->load('images');

            return new CarResource($car);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred during the update process.'], 500);
        }
    }
}
