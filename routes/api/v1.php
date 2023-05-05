<?php

use App\Http\Controllers\Api\v1\Customers\CreateController as CreateCustomerController;
use App\Http\Controllers\Api\v1\Customers\IndexController as CustomerIndexController;
use App\Http\Controllers\Api\v1\Customers\ShowController as CustomerShowController;
use App\Http\Controllers\Api\v1\Customers\UpdateController as CustomerUpdateController;
use Illuminate\Support\Facades\Route;


Route::get("customers", CustomerIndexController::class)->name("customers.index");
Route::post("customers", CreateCustomerController::class)->name("customers.store");
Route::get("customers/{customer:key}", CustomerShowController::class)->name("customers.show");
Route::put("customers/{customer:key}", CustomerUpdateController::class)->name("customers.update");
