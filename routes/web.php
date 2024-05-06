<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/// User Profile Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'ProfileStore'])->name('profile.store');
    //user logout
    Route::get('user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    //change and update pass
    Route::post('password/change/store', [UserController::class, 'UserPasswordUpdate'])->name('password.change.store');
});




require __DIR__.'/auth.php';
