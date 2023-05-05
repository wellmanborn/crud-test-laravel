<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1;

use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowCustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function test_a_client_see_all_customers(): void
    {
        $customer = Customer::factory()->create();

        $this->getJson(route("api.v1.customers.show", $customer["key"]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(["data" => ["first_name" => $customer["first_name"]]]);
    }
}
