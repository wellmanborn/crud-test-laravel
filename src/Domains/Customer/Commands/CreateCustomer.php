<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Commands;

use Illuminate\Support\Str;
use Src\Domains\Customer\Aggregates\CustomerAggregate;
use Src\Domains\Customer\DTO\CustomerDto;
use Src\Domains\Customer\Models\Customer;

class CreateCustomer
{
    public static function handle(CustomerDto $customerDto): Customer
    {
        CustomerAggregate::retrieve(Str::uuid()->toString())->createCustomer($customerDto)->persist();
        return Customer::create($customerDto->toArray());
    }
}
