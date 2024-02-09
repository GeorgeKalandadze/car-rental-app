<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CarRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $user = auth()->user();
            $car = Car::create([
                'make' => $data['make'],
                'model_id' => $data['model_id'],
                'year' => $data['year'],
                'price' => $data['price'],
                'mileage' => $data['mileage'],
                'condition' => $data['condition'],
                'brand_id' => $data['brand_id'],
                'category_id' => $data['category_id'],
                'vin' => $data['vin'],
                'fuel_type' => $data['fuel_type'],
                'user_id' => $user->id,
            ]);

            $images = $data['images'];
            foreach ($images as $index => $image) {
                $imageName = $car->id  . time()  . $index . $image->getClientOriginalName();
                $image->storeAs('public/product_images', $imageName);

                CarImage::create([
                    'car_id' => $car->id,
                    'url' => env('APP_URL').Storage::url('car_images/' . $imageName),
                    'size' => $image->getSize(),
                    'type' => $image->getMimeType(),
                ]);
            }

            DB::commit();
            $car->load('carImages');
            return new CarResource($car);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
