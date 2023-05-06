<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Reactors;

use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;
use Src\Domains\Customer\Events\CustomerCreated;

class CustomerReactor extends Reactor
{
    public function onCustomerCreated(CustomerCreated $event){
        // do something like sending email ....
    }
}
