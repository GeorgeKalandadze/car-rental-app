<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class DeleteCarController extends Controller
{
    public function __invoke(Car $car)
    {
        try {
            // Check if the authenticated user owns the car
            if (auth()->user()->id !== $car->user_id) {
                return response()->json(['error' => 'You are not authorized to delete this car.'], 403);
            }

            DB::beginTransaction();

            foreach ($car->carImages as $carImage) {
                $imageUrl = str_replace(env('APP_URL'), '', $carImage->url);
                Storage::delete('public/product_images/' . basename($imageUrl));
                $carImage->delete();
            }

            $car->delete();

            DB::commit();

            return response()->json(['message' => 'Car deleted successfully']);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
