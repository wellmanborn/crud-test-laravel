<?php

use App\Http\Controllers\Api\v1\Customers\CreateController as CreateCustomerController;
use Illuminate\Support\Facades\Route;


Route::post("customers", CreateCustomerController::class)->name("customers.store");
