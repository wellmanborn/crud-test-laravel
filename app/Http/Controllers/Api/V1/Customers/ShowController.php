<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class ShowController
{
    public function __invoke(Customer $customer) : JsonResponse
    {
        return response()->json(["data" => $customer]);
    }
}
