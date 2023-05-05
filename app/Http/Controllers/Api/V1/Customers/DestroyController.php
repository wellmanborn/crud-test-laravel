<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class DestroyController
{
    public function __invoke(Customer $customer) : JsonResponse
    {
        $customer->delete();
        return response()->json(["status" => true, "data" => "", "errors" => "", "message" => ""]);
    }
}
