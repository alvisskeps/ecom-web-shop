<?php

use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products', [ProductsController::class, 'getAllProducts']);
Route::get('sync-products', [ProductsController::class, 'syncProducts']);
Route::delete('products', [ProductsController::class, 'deleteAllProducts']);
