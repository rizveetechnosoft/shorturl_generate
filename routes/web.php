<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UrlController::class, 'index'])->name('home');
Route::post('/shorten', [UrlController::class, 'store'])->name('shorten');
Route::get('/{short_url}', [UrlController::class, 'redirect'])->name('redirect');

