<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('enrollments', EnrollmentController::class);
    Route::get('/courses/{course}/students', [EnrollmentController::class, 'studentsByCourse']);
    Route::get('/students/{student}/courses', [EnrollmentController::class, 'coursesByStudent']);
});
