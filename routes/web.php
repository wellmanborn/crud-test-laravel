<?php

use App\Http\Controllers\Web\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customers', [CustomerController::class, "index"])->name("customers.index");
Route::get('/customers/create', [CustomerController::class, "create"])->name("customers.create");
Route::get('/customers/{customer}', [CustomerController::class, "show"])->name("customers.show");
Route::post('/customers', [CustomerController::class, "store"])->name("customers.store");
Route::get('/customers/{customer}/edit', [CustomerController::class, "edit"])->name("customers.edit");
Route::put('/customers/{customer}', [CustomerController::class, "update"])->name("customers.update");
Route::delete('/customers/{customer}', [CustomerController::class, "delete"])->name("customers.delete");
Route::view('/swagger', 'swagger');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
