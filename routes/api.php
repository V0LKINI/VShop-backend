<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomeController;
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

Route::get('/', function (Request $request) {
    return 'VShop API startpoint';
});

Route::get('/home', [HomeController::class, 'index']);

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});
