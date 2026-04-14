<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'users' => User::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
        ];

        // 1. Employees per Department (Pie Chart)
        $departments = Department::withCount('employees')->get();
        $deptChartData = [
            'labels' => $departments->pluck('name')->toArray(),
            'data' => $departments->pluck('employees_count')->toArray(),
        ];

        // 2. Attendances over the last 7 days (Bar Chart)
        $attendanceDates = [];
        $attendanceCounts = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $attendanceDates[] = Carbon::parse($date)->format('M d');
            $attendanceCounts[] = Attendance::whereDate('date', $date)->count();
        }

        $attChartData = [
            'labels' => $attendanceDates,
            'data' => $attendanceCounts,
        ];

        return view('dashboard', [
            'stats' => $stats,
            'user' => $request->user(),
            'deptChartData' => $deptChartData,
            'attChartData' => $attChartData,
        ]);
    }
}
