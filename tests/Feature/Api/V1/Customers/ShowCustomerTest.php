<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1\Customers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowCustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function test_a_client_can_see_a_specific_customer(): void
    {
        $customer = Customer::factory()->create();

        $this->getJson(route("api.v1.customers.show", $customer["key"]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(["data" => ["attributes" => ["first_name" => $customer["first_name"]]]]);
    }
}
