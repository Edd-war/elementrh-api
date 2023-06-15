<?php

namespace App\Http\Controllers;

use Exception;
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
        try
        {
            return response()->json([
                'companies' => Company::all(),
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al obtener las compañías',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
        try
        {
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
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al crear la compañía',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): JsonResponse
    {
        //
        try
        {
            return response()->json([
                'company' => $company,
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al obtener la compañía',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
        try
        {
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
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al actualizar la compañía',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
        try
        {
            $company->delete();
            
            return response()->json([
                'message' => 'Compañía eliminada exitosamente',
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al eliminar la compañía',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
