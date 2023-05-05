<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class UpdateController
{
    public function __invoke(UpdateCustomerRequest $request, Customer $customer) : JsonResponse
    {
        $data = [
            "first_name" => $request->get("first_name") ?? $customer->first_name,
            "last_name" => $request->get("last_name") ?? $customer->last_name,
            "email" => $request->get("email") ?? $customer->email,
            "phone_number" => $request->get("phone_number") ?? $customer->phone_number,
            "date_of_birth" => $request->get("date_of_birth") ?? $customer->date_of_birth,
            "bank_account_number" => $request->get("bank_account_number") ?? $customer->bank_account_number
        ];
        $customer->update($data);
        return response()->json(["status" => true, "data" => "", "errors" => "", "message" => ""]);
    }
}
