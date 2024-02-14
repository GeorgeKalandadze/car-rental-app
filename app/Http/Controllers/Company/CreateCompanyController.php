<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Storage;

class CreateCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompanyRequest $request)
    {
        try {
            $data = $request->validated();

            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoPath = $logo->store('public/logos');
            }

            $company = Company::create([
                'owner_id' => auth()->id(),
                'name' => $data['name'],
                'logo' => $logoPath ? Storage::url($logoPath) : null,
                'address' => $data['address'],
                'mobile_number' => $data['mobile_number'],
                'email' => $data['email'],
                'website' => $data['website'],
                'description' => $data['description'],
            ]);

            return response()->json(['company' => $company, 'message' => 'Company created successfully'], 201);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }
}
