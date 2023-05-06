<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Resources\Api\V1\CustomerResource;
use Illuminate\Http\JsonResponse;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

class ShowController
{
    public function __invoke(Customer $customer): JsonResponse
    {
        return response()->json([
            "status" => true,
            "data" => new CustomerResource($customer),
            "errors" => [],
            "message" => ""
        ]);
    }
}
