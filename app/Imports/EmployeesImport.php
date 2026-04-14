<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Skip the heading row
    }

    public function model(array $row)
    {
        // Don't process empty rows
        if (!isset($row[0])) {
            return null;
        }

        return new Employee([
            'name' => $row[0],
            'email' => $row[1],
            'phone' => $row[2],
            'iqama' => $row[3],
            'department_id' => Department::where('name', $row[4])->first()->id ?? null,
            'designation' => $row[5],
            'joining_date' => is_numeric($row[6]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]) : $row[6],
            'status' => $row[7] ?? 'active',
        ]);
    }
}