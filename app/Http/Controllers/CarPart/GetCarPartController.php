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
        $carParts = CarPart::with('brand', 'category', 'images', 'user', 'model')->get();
        return CarPartResource::collection($carParts);
    }
}
