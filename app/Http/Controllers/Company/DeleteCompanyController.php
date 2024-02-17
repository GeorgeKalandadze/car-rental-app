<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Company $company): JsonResponse
    {
        if ($company->owner_id !== auth()->id()) {
            return response()->json(['error' => 'You are not authorized to delete this company.'], 403);
        }
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted successfully'], 200);
    }
}
