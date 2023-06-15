<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
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
                'positions' => Position::all(),
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al obtener las posiciones',
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
            
            $position = new Position();
            $position->name = $request->name;
            $position->save();
            
            return response()->json([
                'message' => 'Posición creada exitosamente',
                'position' => $position,
            ], JsonResponse::HTTP_CREATED);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al crear la posición',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position): JsonResponse
    {
        //
        try
        {
            return response()->json([
                'position' => $position,
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al obtener la posición',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position): JsonResponse
    {
        //
        try
        {
            $request->validate([
                'name' => 'required|min:3|max:32',
            ]);
            
            $position->name = $request->name;
            $position->save();
            
            return response()->json([
                'message' => 'Posición actualizada exitosamente',
                'position' => $position,
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al actualizar la posición',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position): JsonResponse
    {
        //
        try
        {
            $position->delete();
            
            return response()->json([
                'message' => 'Posición eliminada exitosamente',
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al eliminar la posición',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
