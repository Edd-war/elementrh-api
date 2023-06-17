<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return 
        [
            'employees' => $this->collection->transform(function($employee)
            {
                return [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name'  => $employee->last_name,
                    'start_date' => $employee->start_date,
                    // 'position_id'=> $employee->position_id,
                    'position' => $employee->position,
                    // 'company_id' => $employee->company_id,
                    'company' => $employee->company,
                ];
            })
        ];
    }
}
