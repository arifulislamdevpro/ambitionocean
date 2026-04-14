<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'stats' => [
            'users' => User::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
        ],
        'user' => request()->user(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('departments', DepartmentController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('employees', EmployeeController::class);

    Route::get('employees-export', [EmployeeController::class, 'export']);
    Route::post('employees-import', [EmployeeController::class, 'import']);
    Route::get('employees-demo', [EmployeeController::class, 'demo']);
});

require __DIR__.'/auth.php';
