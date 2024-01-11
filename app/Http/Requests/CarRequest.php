<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'mileage' => 'required|numeric',
            'condition' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'images' => ['required', 'array', 'max:4'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'vin' => ['required', 'string', 'min:7', 'regex:/^[a-zA-Z0-9]+$/']
        ];
    }
}
