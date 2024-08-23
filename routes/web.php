<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\MyCoordinationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\HomeController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home',[HomeController::class,'index'])->name('home');

Route::get('/', [MyPageController::class, 'index'])->name('/');

Route::get('/recommends/all', [RecommendController::class, 'all'])->name('/recommends/all');
Route::get('/recommends/{recommend}/comment', [RecommendController::class, 'commentForm'])->name('recommend.commentForm');
Route::post('/recommends/{recommend}/comment', [RecommendController::class, 'comment']);
Route::post('/recommends/{recommend}/comment/{review}/reply', [RecommendController::class, 'reply'])->name('recommend.reply');
Route::get('/recommends/index', [RecommendController::class, 'index'])->name('/recommends/index');
Route::post('/recommends', [RecommendController::class, 'store']);
Route::get('/recommends/{recommend}', [RecommendController::class, 'show']);

Route::get('/consults/all', [ConsultController::class, 'all'])->name('/consults/all');
Route::get('/consults/{consult}/comment', [ConsultController::class, 'commentForm'])->name('consult.commentForm');
Route::post('/consults/{consult}/comment', [ConsultController::class, 'comment']);
Route::post('/consults/{consult}/comment/{review}/reply', [ConsultController::class, 'reply'])->name('consult.reply');
Route::get('/consults/index', [ConsultController::class, 'index'])->name('/consults/index');
Route::post('/consults', [ConsultController::class, 'store']);
Route::get('/consults/{consult}', [ConsultController::class, 'show']);

Route::get('/my_coordinations/delete', [MyCoordinationController::class, 'showDeleteForm'])->name('/my_coordinations/delete');
Route::post('/my_coordinations/delete', [MyCoordinationController::class, 'deleteByDay'])->name('/my_coordinations/delete');
Route::get('/my_coordinations/index', [MyCoordinationController::class, 'index'])->name('/my_coordinations/index');
Route::post('/my_coordinations', [MyCoordinationController::class, 'store']);
Route::get('/my_coordinations/{my_coordination}', [MyCoordinationController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

