<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'storeStep1']);
Route::get('/home/create', [App\Http\Controllers\HomeController::class, 'create']);
Route::get('/home/create/step-2', [App\Http\Controllers\HomeController::class, 'createStep2']);
Route::get('/home/edit/step-2/{id}', [App\Http\Controllers\HomeController::class, 'editStep2']);
Route::get('/home/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit']);
Route::put('/home/update/{id}', [App\Http\Controllers\HomeController::class, 'update']);
Route::delete('/home/delete/{id?}', [App\Http\Controllers\HomeController::class, 'destroy']);
