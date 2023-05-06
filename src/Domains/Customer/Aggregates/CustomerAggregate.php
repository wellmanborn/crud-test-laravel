<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Aggregates;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use Src\Domains\Customer\DTO\CustomerDto;
use Src\Domains\Customer\Events\CustomerCreated;

class CustomerAggregate extends AggregateRoot
{
    public function createCustomer(CustomerDto $customerDto): CustomerAggregate
    {

        $this->recordThat(
            new CustomerCreated($customerDto)
        );
        return $this;
    }
}
