<?php

use App\Http\Controllers\Api\v1\Customers\CreateController as CreateCustomerController;
use App\Http\Controllers\Api\v1\Customers\IndexController as CustomerIndexController;
use Illuminate\Support\Facades\Route;


Route::get("customers", CustomerIndexController::class)->name("customers.index");
Route::post("customers", CreateCustomerController::class)->name("customers.store");
