<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Handle login form submission
Route::post('/login', [AuthenticatedSessionController::class, 'store']);;


Route::get('/contact-form', [ContactController::class, 'showForm']);

Route::middleware(['auth'])->get('/home', [ContactController::class, 'index'])->name('admin.dashboard');