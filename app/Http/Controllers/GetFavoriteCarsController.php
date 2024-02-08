<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use Illuminate\Http\Request;

class GetFavoriteCarsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $favoriteCars = $user->favoriteCars()->get();

        return CarResource::collection($favoriteCars);
    }
}
