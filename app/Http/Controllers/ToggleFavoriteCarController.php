<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class ToggleFavoriteCarController extends Controller
{
    public function __invoke(Request $request, Car $car)
    {
        $user = $request->user();

        if ($user->favoriteCars->contains($car)) {
            $user->favoriteCars()->detach($car);
            return response()->json(['message' => 'Car removed from favorites'], 200);
        } else {
            $user->favoriteCars()->attach($car);
            return response()->json(['message' => 'Car added to favorites'], 201);
        }
    }
}
