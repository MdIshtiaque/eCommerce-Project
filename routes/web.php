<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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
    return view('forntend.pages.home');
});
// Route::get('/admin', function () {
//     return view('backend.pages.Auth.login');
// });

Route::prefix('admin/')->group(function(){
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login_val', [LoginController::class, 'login_val'])->name('admin.login_val');
    //Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index');
    });

});
