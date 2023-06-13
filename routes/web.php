<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntitiesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CompanyController;

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
    return view('welcome');
});

Route::get('entities/{id}', [EntitiesController::class, 'show']);
Route::put('transactions/{transaction}/{entity_id}', [TransactionController::class, 'update'])->where('transaction', 'withdraw|topup');
Route::get('company-balance', [CompanyController::class, 'index']);
Route::get('entities', [EntitiesController::class, 'index']);
