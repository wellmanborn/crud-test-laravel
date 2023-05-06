<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Commands;

use Src\Domains\Customer\Models\Customer;

class DestroyCustomer
{
    public static function handle(Customer $customer): bool
    {
        return $customer->delete();
    }
}
