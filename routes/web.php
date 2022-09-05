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
    Route::post('/', [App\Http\Controllers\ItemController::class, 'index'])->name('item-post');
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name('edit')->middleware('AdminMiddleware');
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [App\Http\Controllers\ItemController::class, 'delete'])->name('delete');
});

Route::prefix('calendar')->group(function () {
    Route::get('/', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
});

Route::prefix('account')->group(function () {
    Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::post('/update/{id}', [App\Http\Controllers\AccountController::class, 'update'])->name('account-update');
    Route::post('/delete/{id}', [App\Http\Controllers\AccountController::class, 'delete'])->name('account-delete');
});

Route::prefix('store')->group(function () {
    Route::get('/', [App\Http\Controllers\StoreController::class, 'index'])->name('store')->middleware('AdminMiddleware');
    Route::post('/', [App\Http\Controllers\StoreController::class, 'index']);
    Route::post('/maker-add', [App\Http\Controllers\StoreController::class, 'makerAdd'])->name('maker-add');
    Route::post('/maker-update/{id}', [App\Http\Controllers\StoreController::class, 'makerUpdate'])->name('maker-update');
    Route::post('/maker-delete/{id}', [App\Http\Controllers\StoreController::class, 'makerDelete'])->name('maker-delete');
    Route::post('/type-add', [App\Http\Controllers\StoreController::class, 'typeAdd'])->name('type-add');
    Route::post('/type-update/{id}', [App\Http\Controllers\StoreController::class, 'typeUpdate'])->name('type-update');
    Route::post('/type-delete/{id}', [App\Http\Controllers\StoreController::class, 'typeDelete'])->name('type-delete');
});

Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users')->middleware('AdminMiddleware');
    Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin-update');
    Route::post('/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('admin-delete');
});