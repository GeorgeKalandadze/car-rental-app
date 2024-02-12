<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
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
                $imageName = $car->id.time().$index.$image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $car->images()->create([
                    'car_id' => $car->id,
                    'url' => env('APP_URL').Storage::url('images/'.$imageName),
                    'size' => $image->getSize(),
                    'type' => $image->getMimeType(),
                ]);
            }

            DB::commit();
            $car->load('images');

            return new CarResource($car);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
