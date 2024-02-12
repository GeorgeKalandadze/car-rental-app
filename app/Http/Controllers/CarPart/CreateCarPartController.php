<?php

namespace App\Http\Controllers\CarPart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarPartRequest;
use App\Http\Resources\CarPartResource;
use App\Models\CarPart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateCarPartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CarPartRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $user = auth()->user();
            $carPart = CarPart::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'condition' => $data['condition'],
                'category_id' => $data['category_id'],
                'brand_id' => $data['brand_id'],
                'model_id' => $data['model_id'],
                'user_id' => $user->id,
            ]);

            $images = $data['images'];
            foreach ($images as $index => $image) {
                $imageName = $carPart->id.time().$index.$image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $carPart->images()->create([
                    'url' => env('APP_URL').Storage::url('images/'.$imageName),
                    'size' => $image->getSize(),
                    'type' => $image->getMimeType(),
                ]);
            }

            DB::commit();
            $carPart->load('images');

            return new CarPartResource($carPart);
        } catch (Exception $exception) {
            Db::rollBack();
            throw $exception;
        }
    }
}
