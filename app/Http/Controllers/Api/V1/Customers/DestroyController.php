<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use Illuminate\Http\JsonResponse;
use Src\Domains\Customer\Commands\DestroyCustomer;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

class DestroyController
{
    public function __invoke(Customer $customer) : JsonResponse
    {

        DestroyCustomer::handle($customer);

        return response()->json(["status" => true, "data" => "", "errors" => "", "message" => ""]);
    }
}
