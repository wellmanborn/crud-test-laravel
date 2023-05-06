<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Commands;

use Src\Domains\Customer\DTO\CustomerDto;
use Src\Domains\Customer\Models\Customer;

class UpdateCustomer
{
    public static function handle(CustomerDto $customerDto, Customer $customer): bool
    {
        return $customer->update($customerDto->toArray());
    }
}
