<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;
use Src\Domains\Customer\DTO\CustomerDto;

class CustomerCreated extends ShouldBeStored
{
    public function __construct(
        public CustomerDto $customerDto
    )
    {
    }
}
