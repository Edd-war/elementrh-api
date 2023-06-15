<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        return response()->json([
            'companies' => Company::all(),
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
        $request->validate([
            'name' => 'required|min:3|max:32',
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->save();

        return response()->json([
            'message' => 'Compañía creada exitosamente',
            'company' => $company,
        ], JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): JsonResponse
    {
        //
        return response()->json([
            'company' => $company,
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
        $request->validate([
            'name' => 'required|min:3|max:32',
        ]);

        $company->name = $request->name;
        $company->save();

        return response()->json([
            'message' => 'Compañía actualizada exitosamente',
            'company' => $company,
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
        $company->delete();

        return response()->json([
            'message' => 'Compañía eliminada exitosamente',
        ], JsonResponse::HTTP_OK);
    }
}
