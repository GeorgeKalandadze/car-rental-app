<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class GetCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cars = Car::with('brand', 'category', 'images');

        if ($request->filled('fuel_type')) {
            $cars->where('fuel_type', $request->input('fuel_type'));
        }

        if ($request->filled('name')) {
            $name = $request->input('name');
            $cars->where(function ($query) use ($name) {
                $query->where('make', 'like', "%$name%")
                    ->orWhere('model', 'like', "%$name%");
            });
        }

        if ($request->filled('year')) {
            $cars->where('year', $request->input('year'));
        }

        $filteredCars = $cars->get();
        return response()->json($filteredCars);
    }
}
