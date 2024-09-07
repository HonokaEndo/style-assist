<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RecommendController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\MyCoordinationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;





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

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // ログアウト後にlogin画面にリダイレクト
})->name('logout');


Route::get('/home',[HomeController::class,'index'])->name('home');

Route::get('/', [MyPageController::class, 'index'])->name('/');

Route::get('/recommends/all', [RecommendController::class, 'all'])->name('/recommends/all');
Route::get('/recommends/{recommend}/comment', [RecommendController::class, 'commentForm'])->name('recommend.commentForm');
Route::post('/recommends/{recommend}/comment', [RecommendController::class, 'comment']);
Route::post('/recommends/{recommend}/comment/{review}/reply', [RecommendController::class, 'reply'])->name('recommend.reply');
Route::get('/recommends/delete', [RecommendController::class, 'deleteForm'])->name('recommend.deleteForm');
Route::post('/recommends/{recommend}/delete', [RecommendController::class, 'delete'])->name('recommend.delete');
Route::get('/recommends/{recommend}/edit', [RecommendController::class, 'edit'])->name('recommend.edit');
Route::put('/recommends/{recommend}', [RecommendController::class, 'update'])->name('recommend.update');
Route::get('/recommends/index', [RecommendController::class, 'index']);
Route::post('/recommends', [RecommendController::class, 'store']);

Route::get('/consults/all', [ConsultController::class, 'all'])->name('/consults/all');
Route::get('/consults/{consult}/comment', [ConsultController::class, 'commentForm'])->name('consult.commentForm');
Route::post('/consults/{consult}/comment', [ConsultController::class, 'comment']);
Route::post('/consults/{consult}/comment/{review}/reply', [ConsultController::class, 'reply'])->name('consult.reply');
Route::get('/consults/delete', [ConsultController::class, 'deleteForm'])->name('consult.deleteForm');
Route::post('/consults/{consult}/delete', [ConsultController::class, 'delete'])->name('consult.delete');
Route::get('/consults/{consult}/edit', [ConsultController::class, 'edit'])->name('consult.edit');
Route::put('/consults/{consult}', [ConsultController::class, 'update'])->name('consult.update');
Route::get('/consults/index', [ConsultController::class, 'index']);
Route::post('/consults', [ConsultController::class, 'store']);

Route::get('/my_coordinations/delete', [MyCoordinationController::class, 'showDeleteForm']);
Route::post('/my_coordinations/delete', [MyCoordinationController::class, 'deleteByDay']);
Route::get('/my_coordinations/index', [MyCoordinationController::class, 'index']);
Route::post('/my_coordinations', [MyCoordinationController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
