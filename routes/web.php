<?php

use App\Http\Controllers\HasilController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SiswaController;
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
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('siswa', SiswaController::class);
    Route::resource('kuis', KuisController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('hasil', HasilController::class);
    Route::get('materi/detail-materi/create/{id}', [MateriController::class, 'create_detail']);
    Route::get('materi/open/{id}', [MateriController::class, 'open']);
    Route::get('materi/close/{id}', [MateriController::class, 'close']);
    Route::get('materi/detail-destroy/{id}', [MateriController::class, 'detail_destroy']);
    Route::get('materi/update-status/{id}', [MateriController::class, 'update_status']);
    Route::get('kuis/open/{id}', [KuisController::class, 'open']);
    Route::post('kuis/jawab/{id}', [KuisController::class, 'jawab']);
    Route::post('materi/detail-materi/store', [MateriController::class, 'store_detail']);
});
