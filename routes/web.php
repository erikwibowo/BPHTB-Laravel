<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PpatController;
use App\Http\Controllers\WpController;
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

Route::get('admin/login', function () {
    return view('admin/login', ['title' => "Login | " . config('variable.webname')]);
})->name('admin.login');
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//AMINISTRATOR
Route::group(['prefix' => 'admin',  'middleware' => 'adminauth'], function () {
    Route::get('/', function () {
        return view('admin/dashboard', ['title' => "Dashboard"]);
    })->name('admin.dashboard');
    //Admin
    Route::get('admin', [AdminController::class, 'index'])->name('admin.admin.index');
    Route::post('admin/create', [AdminController::class, 'create'])->name('admin.admin.create');
    Route::put('admin/update', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::delete('admin/delete', [AdminController::class, 'delete'])->name('admin.admin.delete');
    Route::post('admin/data', [AdminController::class, 'data'])->name('admin.admin.data');
    //PPAT
    Route::get('ppat', [PpatController::class, 'index'])->name('admin.ppat.index');
    Route::post('ppat/create', [PpatController::class, 'create'])->name('admin.ppat.create');
    Route::put('ppat/update', [PpatController::class, 'update'])->name('admin.ppat.update');
    Route::delete('ppat/delete', [PpatController::class, 'delete'])->name('admin.ppat.delete');
    Route::post('ppat/data', [PpatController::class, 'data'])->name('admin.ppat.data');
    //WP
    Route::get('wp', [WpController::class, 'index'])->name('admin.wp.index');
    Route::post('wp/create', [WpController::class, 'create'])->name('admin.wp.create');
    Route::put('wp/update', [WpController::class, 'update'])->name('admin.wp.update');
    Route::delete('wp/delete', [WpController::class, 'delete'])->name('admin.wp.delete');
    Route::post('wp/data', [WpController::class, 'data'])->name('admin.wp.data');
});
