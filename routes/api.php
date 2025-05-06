<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\CompanyController;
use \App\Http\Controllers\EmployeeController;

use App\Models\Company;
use App\Models\Employee;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Company routes
    Route::post('/companies', [CompanyController::class, 'store'])->can('create', Company::class);
    Route::get('/companies', [CompanyController::class, 'index'])->can('viewAny', Company::class);
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->where('company', '[0-9]+')->can('view', 'company');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->where('company', '[0-9]+')->can('update', 'company');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->where('company', '[0-9]+')->can('delete', 'company');

    // Employee routes
    Route::post('/employees', [EmployeeController::class, 'store'])->can('create', Employee::class);
    Route::get('/employees', [EmployeeController::class, 'index'])->can('viewAny', Employee::class);
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->where('employee', '[0-9]+')->can('view', 'employee');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->where('employee', '[0-9]+')->can('update', 'employee');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->where('employee', '[0-9]+')->can('delete', 'employee');
});