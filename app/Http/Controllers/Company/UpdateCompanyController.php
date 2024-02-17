<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompanyRequest $request, Company $company)
    {
        if ($company->owner_id !== auth()->id()) {
            return response()->json(['error' => 'You are not authorized to update this company.'], 403);
        }
        $validatedData = $request->validated();
        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $logoPath;
        }

        $company->update($validatedData);

        return response()->json(['message' => 'Company updated successfully'], 200);
    }
}
