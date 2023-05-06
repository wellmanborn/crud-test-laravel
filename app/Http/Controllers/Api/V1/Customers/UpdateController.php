<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\JsonResponse;
use Src\Domains\Customer\Commands\UpdateCustomer;
use Src\Domains\Customer\DTO\CustomerDto;
use Src\Domains\Customer\Models\Customer;

class UpdateController
{
    public function __invoke(UpdateCustomerRequest $request, Customer $customer) : JsonResponse
    {
        UpdateCustomer::handle(CustomerDto::update($request->validated(), $customer), $customer);
        return response()->json(["status" => true, "data" => [], "errors" => [], "message" => ""]);
    }
}
