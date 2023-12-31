<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;

class EmployeeController extends Controller
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
                'employees' => new EmployeeCollection(Employee::all()),
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al obtener los empleados',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $employeeRequest): JsonResponse
    {
        //
        try
        {
            $employee = new Employee();
            $employee->first_name = $employeeRequest->first_name;
            $employee->last_name = $employeeRequest->last_name;
            $employee->start_date = $employeeRequest->start_date;
            $employee->company_id = $employeeRequest->company_id;
            $employee->position_id = $employeeRequest->position_id;
            $employee->save();
            
            return response()->json([
                'message' => 'Empleado creado exitosamente',
                'employee' => $employee,
            ], JsonResponse::HTTP_CREATED);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al crear el empleado',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee): EmployeeResource
    {
        //
        try
        {
            return new EmployeeResource($employee);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al obtener el empleado',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $employeeRequest, Employee $employee): JsonResponse
    {
        //
        try
        {
            $employee->first_name = $employeeRequest->first_name;
            $employee->last_name = $employeeRequest->last_name;
            $employee->start_date = $employeeRequest->start_date;
            $employee->company_id = $employeeRequest->company_id;
            $employee->position_id = $employeeRequest->position_id;
            $employee->save();
            
            return response()->json([
                'message' => 'Empleado actualizado exitosamente',
                'employee' => $employee,
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al actualizar el empleado',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee): JsonResponse
    {
        //
        try
        {
            $employee->delete();
            
            return response()->json([
                'message' => 'Empleado eliminado exitosamente',
            ], JsonResponse::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error al eliminar el empleado',
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
