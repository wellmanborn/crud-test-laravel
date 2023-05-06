<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->key,
            "type" => "customer",
            "attributes" => [
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "email" => $this->email,
                "phone_number" => $this->phone_number,
                "date_of_birth" => $this->date_of_birth,
                "bank_account_number" => $this->bank_account_number,
            ],
            "links" => [
                "self" => route("api.v1.customers.show", $this->key),
                "parent" => route("api.v1.customers.index")
            ]
        ];
    }
}
