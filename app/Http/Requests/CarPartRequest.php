<?php

namespace App\Http\Requests;

use App\Enums\Condition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarPartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'condition' => ['required', Rule::in(Condition::toArray())],
            'price' => 'required|numeric',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:car_models,id',
            'category_id' => 'required|exists:car_part_categories,id',
            'images' => ['required', 'array', 'max:4'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
