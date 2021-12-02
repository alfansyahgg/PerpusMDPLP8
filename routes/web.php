<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PinjamanController;

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

Route::get('/', [ HomeController::class, 'index' ] );
Route::get('loadMore', [ HomeController::class, 'getDataMore'] )->name('home.loadMore');
Route::get('lihat/{id}', [ HomeController::class, 'lihat'] )->name('home.lihat');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('auth', [LoginController::class, 'auth'])->name('auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['MustLogin'])->group(function () {

    Route::post('pinjam/{id}', [ HomeController::class, 'pinjam'] )->name('home.pinjam');
    Route::get('pinjaman/{id}', [ HomeController::class, 'pinjaman'] )->name('home.pinjaman');
    Route::post('kembali/{id_buku}', [ HomeController::class, 'kembali'] )->name('book.kembali');
    
});


Route::middleware(['auth', 'MustLogin', 'MustAdmin'])->group(function () {
    Route::prefix('admin')->group(function(){
        Route::resource('book', BookController::class);
        Route::resource('pinjam', PinjamanController::class);

        Route::get('book/remove/{id}', [ BookController::class, 'remove' ])->name('remove');

        Route::get('pinjam/approve/{id}', [ PinjamanController::class, 'approve' ])->name('pinjam.approve');
        Route::get('pinjam/reject/{id}', [ PinjamanController::class, 'reject' ])->name('pinjam.reject');

    });
});

