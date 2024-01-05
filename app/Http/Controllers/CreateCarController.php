<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
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
            $car = Car::create([
                'make' => $data['make'],
                'model' => $data['model'],
                'year' => $data['year'],
                'price' => $data['price'],
                'mileage' => $data['mileage'],
                'condition' => $data['condition'],
                'brand_id' => $data['brand_id'],
                'category_id' => $data['category_id'],
            ]);

            $images = $data['images'];
            foreach ($images as $index => $image) {
                $imageName = $car->id  . time()  . $index . $image->getClientOriginalName();
                $image->storeAs('public/product_images', $imageName);

                CarImage::create([
                    'car_id' => $car->id,
                    'name' => env('APP_URL').Storage::url('car_images/' . $imageName),
                    'size' => $image->getSize(),
                    'type' => $image->getMimeType(),
                ]);
            }

            DB::commit();
            $car->load('carImages');
            return response()->json($car);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
