<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Requests\CreateCustomerRequest;
use Illuminate\Http\JsonResponse;
use Src\Domains\Customer\Commands\CreateCustomer;
use Src\Domains\Customer\DTO\CustomerDto;
use Symfony\Component\HttpFoundation\Response;

class CreateController
{
    public function __invoke(CreateCustomerRequest $request) : JsonResponse
    {
        CreateCustomer::handle(
            CustomerDto::create($request->validated())
        );
        return response()->json(["status" => true, "data" => "", "errors" => "", "message" => ""], Response::HTTP_CREATED);
    }
}
