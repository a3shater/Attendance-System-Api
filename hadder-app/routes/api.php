<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\RelationshipController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/gettest', function () {
//     return 'ahmed';
// });




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::apiResource('users', UserController::class);
Route::apiResource('shifts', ShiftController::class);
Route::apiResource('holidays', HolidayController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('attendances', AttendanceController::class);
Route::apiResource('areas', AreaController::class);


Route::get('users/{id}/shifts', [RelationshipController::class, 'userShifts']);
Route::get('users/{id}/holidays', [RelationshipController::class, 'userHolidays']);
Route::get('users/{id}/attendances', [RelationshipController::class, 'userAttendances']);
Route::get('users/{id}/areas', [RelationshipController::class, 'userAreas']); //

Route::get('shifts/{id}/users', [RelationshipController::class, 'shiftUsers']);
Route::get('holidays/{id}/users', [RelationshipController::class, 'holidayUsers']);
Route::get('areas/{id}/users', [RelationshipController::class, 'areaUsers']);//

// Route::get('companies/{id}/areas', [RelationshipController::class, 'companyAreas']);//company
