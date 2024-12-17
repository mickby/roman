<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/convert', [ConversionController::class, 'convert'])->name('convert');
Route::get('/recent', [ConversionController::class, 'recentConversions'])->name('recent');
Route::get('/top', [ConversionController::class, 'topConversions'])->name('top');
