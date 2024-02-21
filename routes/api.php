<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/get-header', [App\Http\Controllers\Api\ApiController::class, 'getHeader'])->name('get-header');
Route::get('/get-tech-stack', [App\Http\Controllers\Api\ApiController::class, 'getTechStack'])->name('get-tech-stack');
Route::get('/get-work-exp', [App\Http\Controllers\Api\ApiController::class, 'getWorkExp'])->name('get-work-exp');
Route::get('/get-projects', [App\Http\Controllers\Api\ApiController::class, 'getProjects'])->name('get-projects');
Route::get('/get-articles', [App\Http\Controllers\Api\ApiController::class, 'getArticles'])->name('get-articles');
Route::get('/show/{slug}', [App\Http\Controllers\Api\ApiController::class, 'getArticle'])->name('get-article');
