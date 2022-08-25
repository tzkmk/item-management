<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('item-home');
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
});

Route::prefix('store')->group(function () {
    Route::get('/', [App\Http\Controllers\StoreController::class, 'index'])->name('store');
    Route::post('/maker-add', [App\Http\Controllers\StoreController::class, 'makerAdd'])->name('maker-add');
    Route::post('/type-add', [App\Http\Controllers\StoreController::class, 'typeAdd'])->name('type-add');
});

Route::prefix('calendar')->group(function () {
    Route::get('/', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
});

Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');

});