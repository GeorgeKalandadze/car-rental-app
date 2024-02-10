<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteCarController extends Controller
{
    public function __invoke(Car $car)
    {
        try {

            if (auth()->user()->id !== $car->user_id) {
                return response()->json(['error' => 'You are not authorized to delete this car.'], 403);
            }

            DB::beginTransaction();
            foreach ($car->images as $carImage) {
                $imageUrl = str_replace(env('APP_URL'), '', $carImage->url);

                Storage::delete('public/images/' . basename($imageUrl));
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
