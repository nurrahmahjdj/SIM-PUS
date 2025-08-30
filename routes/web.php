<?php

use App\Http\Controllers\KaryaIlmiahController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DashboardRumpunController;
use App\Http\Controllers\DashboardKaryaIlmiahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web rophputes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [KaryaIlmiahController::class, 'home']);
Route::get('/about', [KaryaIlmiahController::class, 'about']);

Route::resource('/karyailmiah', KaryaIlmiahController::class);

Route::get('/login', [LoginController:: class, 'index'])->middleware('guest');
Route::post('/login', [LoginController:: class, 'authenticate']);
Route::post('/logout', [LoginController:: class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin');


Route::resource('/dashboard/mahasiswa', DashboardMahasiswaController::class)->except('show')->middleware('admin');
Route::post('/dashboard/mahasiswa/{npm}', [DashboardMahasiswaController:: class, 'reset'])->middleware('admin');
Route::resource('/dashboard/rumpun', DashboardRumpunController::class)->except(['show', 'edit', 'update'])->middleware('admin');
Route::resource('/dashboard/karyailmiah', DashboardKaryaIlmiahController::class)->middleware('admin');
Route::get('/dashboard/reports', [DashboardReportController::class, 'index'])->middleware('admin');
Route::get('/filters', [DashboardReportController::class, 'filters'])->middleware('admin');
Route::get('/exportpdf', [DashboardReportController::class, 'exportpdf']);


Route::get('/user/post', [UserController::class, 'post'])->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');

Route::post('/importexcel', [DashboardMahasiswaController::class, 'importexcel']);