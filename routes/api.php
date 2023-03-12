<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AutenticarController;
use App\Http\Controllers\Colegiocontroller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::prefix('authenticacion')->group(function () {
    Route::post('login',[AutenticarController::class,'login']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('authenticacion/user',[UserController::class,'user']);
});

Route::get('test/{response}',[AdminController::class,'test']);


Route::get('admins',[AdminController::class,'index']);
Route::post('admins',[AdminController::class,'store']);
Route::get('admins/{admin}',[AdminController::class,'show']);
Route::put('admins-edit/{admin}',[AdminController::class,'update']);
Route::delete('admins/{admin}',[AdminController::class,'destroy']);

Route::get('student',[StudentController::class,'index']);
Route::post('student',[StudentController::class,'store']);
Route::get('student/{student}',[StudentController::class,'show']);
Route::put('student/{student}',[StudentController::class,'update']);
Route::delete('student/{student}',[StudentController::class,'destroy']);

Route::get('colegios',[Colegiocontroller::class,'index']);
Route::post('colegios',[Colegiocontroller::class,'store']);
Route::get('colegios/{colegio}',[Colegiocontroller::class,'show']);
Route::put('colegios/{colegio}',[Colegiocontroller::class,'update']);
Route::delete('colegios/{colegio}',[Colegiocontroller::class,'destroy']);





// Route::post('logout',[AutenticarController::class,'logout'])->middleware('auth:sanctum');

Route::put('colegios/{colegio}',[Colegiocontroller::class,'update']);

Route::group(['middleware' =>['auth:sanctum']],function(){
    Route::prefix('admin')->group(function () {
        Route::post('logout',[AutenticarController::class,'logout']);
    });

});