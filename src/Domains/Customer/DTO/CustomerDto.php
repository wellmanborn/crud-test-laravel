<?php

declare(strict_types=1);

namespace Src\Domains\Customer\DTO;

use Src\Domains\Customer\Models\Customer;

class CustomerDto
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $phone_number,
        public readonly string $date_of_birth,
        public readonly string $bank_account_number
    )
    {
    }

    public static function create($attributes) : CustomerDto
    {
        return new self(
            $attributes["first_name"],
            $attributes["last_name"],
            $attributes["email"],
            $attributes["phone_number"],
            $attributes["date_of_birth"],
            $attributes["bank_account_number"],
        );
    }

    public static function update(array $attributes, Customer $customer) : CustomerDto
    {
        return new self(
            $attributes["first_name"] ?? $customer->first_name,
            $attributes["last_name"] ?? $customer->last_name,
            $attributes["email"] ?? $customer->email,
            $attributes["phone_number"] ?? $customer->phone_number,
            $attributes["date_of_birth"] ?? $customer->date_of_birth,
            $attributes["bank_account_number"] ?? $customer->bank_account_number,
        );
    }

    public function toArray() : array
    {
        return [
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "date_of_birth" => $this->date_of_birth,
            "bank_account_number" => $this->bank_account_number,
        ];
    }

}
