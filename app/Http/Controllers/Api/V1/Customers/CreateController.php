<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Requests\CreateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CreateController
{
    public function __invoke(CreateCustomerRequest $request) : JsonResponse
    {

        $data = [
            "first_name" => $request->get("first_name"),
            "last_name" => $request->get("last_name"),
            "email" => $request->get("email"),
            "phone_number" => $request->get("phone_number"),
            "date_of_birth" => $request->get("date_of_birth"),
            "bank_account_number" => $request->get("bank_account_number")
        ];
        Customer::create($data);
        return response()->json(["status" => true, "data" => "", "errors" => "", "message" => ""], 201);
    }
}
