<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Projectors;

use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Src\Domains\Customer\Commands\CreateCustomer;
use Src\Domains\Customer\Events\CustomerCreated;

class CustomerProjector extends Projector
{
    public function onCustomerCreated(CustomerCreated $customer): void
    {
        CreateCustomer::handle($customer->customerDto);
    }

}
