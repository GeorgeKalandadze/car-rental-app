<?php

namespace App\Http\Controllers\CarPart;

use App\Http\Controllers\Controller;
use App\Models\CarPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;

class DeleteCarPartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CarPart $carPart)
    {
        try {

            if (auth()->user()->id !== $carPart->user_id) {
                return response()->json(['error' => 'You are not authorized to delete this car part.'], 403);
            }

            DB::beginTransaction();
            foreach ($carPart->images as $image) {
                $imageUrl = str_replace(env('APP_URL'), '', $image->url);

                Storage::delete('public/images/' . basename($imageUrl));
                $image->delete();
            }
            $carPart->delete();

            DB::commit();
            return response()->json(['message' => 'Car part deleted successfully']);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
