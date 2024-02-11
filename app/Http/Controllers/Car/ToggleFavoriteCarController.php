<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Notifications\CarLikedNotification;
use Illuminate\Http\Request;

class ToggleFavoriteCarController extends Controller
{
    public function __invoke(Request $request, Car $car)
    {
        $user = $request->user();

        if ($user->favoriteCars->contains($car)) {
            $user->favoriteCars()->detach($car);
            $car->user->notify(new CarLikedNotification($car, $user, 'removed'));
            return response()->json(['message' => 'Car removed from favorites'], 200);
        } else {
            $user->favoriteCars()->attach($car);
            $car->user->notify(new CarLikedNotification($car, $user, 'added'));
            return response()->json(['message' => 'Car added to favorites'], 201);
        }
    }
}
