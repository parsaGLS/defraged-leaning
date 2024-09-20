<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login_SuperAdmin',[\App\Http\Controllers\AuthController::class,'login_SuperAdmin']);
Route::get('me',[\App\Http\Controllers\AuthController::class,'me'])->middleware('auth:sanctum');




Route::apiResource('/object_configs',\App\Http\Controllers\ObjectConfigController::class);
Route::apiResource('/communications',\App\Http\Controllers\CommunicationController::class)->middleware('auth:sanctum');
Route::apiResource('/cameras',\App\Http\Controllers\CameraController::class);
//camera group api
Route::post('/cameraGroups',[\App\Http\Controllers\CameraGroupController::class,'store']);
Route::get('/cameraGroups',[\App\Http\Controllers\CameraGroupController::class,'index']);
Route::put('/cameraGroups/{cameraGroup}',[\App\Http\Controllers\CameraGroupController::class,'update']);
Route::delete('/cameraGroups/{cameraGroup}',[\App\Http\Controllers\CameraGroupController::class,'destroy']);
Route::put('/cameraGroups/{cameraGroup}/cameras',[\App\Http\Controllers\CameraGroupController::class,'assignCamera']);
Route::delete('/cameraGroups/{cameraGroup}/cameras/{camera}',[\App\Http\Controllers\CameraGroupController::class,'designCamera']);
// User Control
Route::apiResource('/users',\App\Http\Controllers\UserController::class)->middleware('auth:sanctum');

Route::post('/sendCode',[\App\Http\Controllers\OTPController::class,'sendCode']);
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);





Route::apiResource('alarms',\App\Http\Controllers\AlarmController::class);
