<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

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

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth()->user();
});


Route::post('add',[DepartmentController::class,'adding']);

Route::put('update/{id}',[DepartmentController::class,'updating']);

Route::delete('delete/{id}',[DepartmentController::class,'delete']);

Route::get('get',[DepartmentController::class,'getData']);


// Routes for TeamController
Route::get('/teamindex', [TeamController::class, 'index']);

Route::post('/teamcreate', [TeamController::class, 'store']);

Route::get('/teamshow/{id}', [TeamController::class, 'show']);

Route::put('/teamupdate', [TeamController::class, 'update']);

Route::delete('/teamdestroy/{id}', [TeamController::class, 'destroy']);

// Routes for TeamMemberController
Route::get('/memberindex', [TeamMemberController::class, 'index']);

Route::post('/membercreate', [TeamMemberController::class, 'store']);

Route::get('/membershow/{id}', [TeamMemberController::class, 'show']);

Route::put('/memberupdate/{id}', [TeamMemberController::class, 'update']);

Route::delete('/memberdestroy/{id}', [TeamMemberController::class, 'destroy']);


Route::post('/create', [TaskController::class, 'assignTask']);
Route::post('/show', [TaskController::class, 'show']);

Route::delete('/delete/{id}', [TaskController::class, 'destroy']);

Route::put('/update/{id}', [TaskController::class, 'Update_task']); // for updating complete start
Route::put('/reassign/{id}', [TaskController::class, 'reassign_task']); // for reassigning the task


Route::middleware('auth:sanctum')->post('/permissions', [PermissionController::class, 'store']);