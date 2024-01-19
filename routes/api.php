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

Route::get('/currencies', 'App\Http\Controllers\CurrenciesController@index');
Route::get('/banks', 'App\Http\Controllers\BankController@index');
Route::get('/banks/{id}', 'App\Http\Controllers\BankController@show');

Route::get('/branches/nearby/{latitude}/{longitude}/{bankId?}', 'App\Http\Controllers\BranchController@getNearestBranches')
    ->where(['latitude' => '[-]?[0-9]+(\.[0-9]+)?', 'longitude' => '[-]?[0-9]+(\.[0-9]+)?']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
