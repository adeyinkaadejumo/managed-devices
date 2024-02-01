<?php

use App\Http\Controllers\Api\V1\DeviceController;
use App\Http\Controllers\Api\V1\DeviceManufacturerController;
use App\Http\Controllers\Api\V1\ExportDevicesController;
use App\Http\Controllers\Api\V1\SimCardController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('devices', [DeviceController::class, 'index']);
    Route::post('devices', [DeviceController::class, 'store']);
    Route::put('devices/{device}', [DeviceController::class, 'update']);
    Route::patch('devices/{device}/deactivate', [DeviceController::class, 'deactivate']);

    Route::get('export-devices', ExportDevicesController::class);

    Route::get('users', [UserController::class, 'index']);
    Route::get('sim_cards', [SimCardController::class, 'index']);
    Route::get('device_manufacturers', [DeviceManufacturerController::class, 'index']);
});
