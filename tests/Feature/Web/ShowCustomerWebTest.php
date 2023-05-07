<?php

declare(strict_types=1);

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowCustomerWebTest extends TestCase
{
    use DatabaseMigrations;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function test_a_client_can_see_a_specific_customer_via_web(): void
    {
        $customer = Customer::factory()->create();

        $this->get(route("customers.show", $customer["id"]))
            ->assertStatus(Response::HTTP_OK)
            ->assertSee($customer["first_name"]);
    }
}
