<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Commands;

use Src\Domains\Customer\DTO\CustomerDto;
use Src\Domains\Customer\Models\Customer;

class CreateCustomer
{
    public static function handle(CustomerDto $customerDto): Customer
    {
        return Customer::create($customerDto->toArray());
    }
}
