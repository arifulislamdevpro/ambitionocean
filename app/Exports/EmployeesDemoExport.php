<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesDemoExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Iqama / ID',
            'Department Name', // Will be queried by name in import
            'Designation',
            'Joining Date',
            'Status'
        ];
    }

    public function array(): array
    {
        return [
            [
                'John Doe',
                'johndoe@example.com',
                '+1234567890',
                '1123456789',
                'IT', // Ensure you have a department with this name
                'Software Developer',
                '2026-04-14',
                'active'
            ],
            [
                'Jane Smith',
                'janesmith@example.com',
                '+0987654321',
                '1098765432',
                'HR',
                'HR Manager',
                '2026-04-15',
                'active'
            ]
        ];
    }
}
