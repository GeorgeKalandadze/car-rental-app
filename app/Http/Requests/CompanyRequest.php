<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Authorization logic
        return true; // For simplicity, you may want to change this based on your application's requirements
    }

    public function rules()
    {
        return [
            'owner_id' => 'required', // Assuming owner_id is a valid foreign key
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'description' => 'required|string',
        ];
    }
}
