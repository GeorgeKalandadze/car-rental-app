<?php

namespace App\Http\Controllers\CarPart;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarPartResource;
use App\Models\CarPart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetCarPartController extends Controller
{
    public function __invoke(Request $request): ResourceCollection
    {
        $name = $request->input('name');
        $condition = $request->input('condition');

        $query = CarPart::query();

        // Apply filters if they exist in the request
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('condition')) {
            $query->where('condition', $request->input('condition'));
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Retrieve the filtered car parts
        $carParts = $query->with('brand', 'category', 'images', 'user', 'model')->get();

        // Return the filtered car parts as a resource collection
        return CarPartResource::collection($carParts);
    }
}

