<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class IndexController
{
    public function __invoke() : JsonResponse
    {
        $customers = Customer::all();
        return response()->json(["data" => $customers]);
    }
}
