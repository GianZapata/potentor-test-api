<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/auth/login', [ AuthController::class, 'login' ]);
Route::post('/auth/signup',[ AuthController::class, 'signup']);

Route::middleware(['auth:sanctum'])->group( function (){
    Route::get('/patients', [ PatientController::class, 'findAll']);
    Route::get('/patients/{patient}', [ PatientController::class, 'findOneById']);
    Route::post('/patients', [ PatientController::class, 'createPatient' ]);
    Route::patch('/patients/{patient}', [ PatientController::class, 'updatePatient' ]);
});




