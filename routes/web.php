<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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

/* ---------------- Get Routes ----------------  */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/login', [LoginController::class,"create"])->name("login");

Route::get('/register',[RegisterController::class,"create"])->name("register");

Route::get('/report', function () {
    return view('report');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware("auth");

Route::get('/getActiveTask', [TaskController::class, 'getDataByActiveStatus']);

Route::get('/user', function (){
    return Auth::user();
});

/* ---------------- Post Routes ----------------  */

Route::post('/loginUser',[LoginController::class,"store"]);

Route::post('/registerUser', [RegisterController::class,"store"]);

Route::post("/insertTask",[TaskController::class,"store"]);

Route::post("/updateStatus",[TaskController::class,"update"]);

Route::post("/updateProfile",[RegisterController::class,"update"]);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
