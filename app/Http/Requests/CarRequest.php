<?php

namespace App\Http\Requests;

use App\Enums\FuelType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'make' => strtoupper($this->make),
            'model' => strtoupper($this->model),
        ]);
        $this->merge([
            'vin' => strtoupper(str_replace(' ', '', $this->vin)),
        ]);
    }
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
            'model_id' => 'required|exists:car_models,id',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'mileage' => 'required|numeric',
            'condition' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'images' => ['required', 'array', 'max:4'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'vin' => ['required', 'string', 'min:7', 'regex:/^[a-zA-Z0-9]+$/'],
            'fuel_type' => ['required',Rule::in(FuelType::toArray())],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'make.required' => 'მწარმოებლის ველი აუცილებელია.',
            'model.required' => 'მოდელის ველი აუცილებელია.',
            'year.required' => 'წელის ველი აუცილებელია.',
            'year.numeric' => 'წელი უნდა იყოს ციფრებით.',
            'price.required' => 'ფასის ველი აუცილებელია.',
            'price.numeric' => 'ფასი უნდა იყოს ციფრებით.',
            'mileage.required' => 'გარბენის ველი აუცილებელია.',
            'mileage.numeric' => 'გარბენა უნდა იყოს ციფრებით.',
            'condition.required' => 'მდგომარეობის ველი აუცილებელია.',
            'brand_id.required' => 'ბრენდის ველი აუცილებელია.',
            'brand_id.exists' => 'არჩეული ბრენდი არასწორია.',
            'category_id.required' => 'კატეგორიის ველი აუცილებელია.',
            'category_id.exists' => 'არჩეული კატეგორია არასწორია.',
            'images.required' => 'მინიმუმ ერთი სურათი აუცილებელია.',
            'images.array' => 'სურათები უნდა იყოს მასივი.',
            'images.max' => 'მხოლოდ ათვლის :max სურათი.',
            'images.*.required' => 'თითოეული სურათი აუცილებელია.',
            'images.*.image' => 'თითოეული ფაილი უნდა იყოს სურათი.',
            'images.*.mimes' => 'თითოეული სურათი უნდა იყოს ფორმატი: jpeg, png, jpg.',
            'images.*.max' => 'თითოეული სურათი არ უნდა გადაავლოს 2048 კილობაიტს.',
            'vin.required' => 'VIN ველი აუცილებელია.',
            'vin.string' => 'VIN უნდა იყოს ტექსტური.',
            'vin.min' => 'VIN უნდა იყოს მინიმუმ 7 სიმბოლო.',
            'vin.regex' => 'VIN ფორმატი არასწორია.',
            'fuel_type.required' => 'წვის ტიპის ველი აუცილებელია.',
            'fuel_type.in' => 'არჩეული წვის ტიპი არასწორია.',
        ];
    }

}
