<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendController;
use App\Http\Controllers\ConsultController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/recommends/index', [RecommendController::class, 'index']);
Route::post('/recommends', [RecommendController::class, 'store']);
Route::get('/recommends/{recommend}', [RecommendController::class, 'show']);

Route::get('/consults/index', [ConsultController::class, 'index']);
Route::post('/consults', [ConsultController::class, 'store']);
Route::get('/consults/{consult}', [ConsultController::class, 'show']);


