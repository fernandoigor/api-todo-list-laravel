<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TypeTodoController;

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




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

Route::controller(TodoController::class)->group(function () {
    Route::get('todos', 'index');
    Route::get('todos/{id}', 'get');
    Route::post('todos', 'create');
    Route::put('todos/{id}', 'update');
    Route::delete('todos/{id}', 'delete');
});
Route::controller(TypeTodoController::class)->group(function () {
    Route::get('todos/type', 'index');
    Route::post('todos/type', 'create');
    Route::put('todos/type/{id}', 'update');
    Route::delete('todos/type/{id}', 'delete');
});
