<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1;

use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CustomerIndexTest extends TestCase
{
    use DatabaseMigrations;

    protected Customer $customer;
    protected CustomerIndexTest $request;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function test_a_client_see_all_customers(): void
    {
        $customer1 = Customer::factory()->create();
        $customer2 = Customer::factory()->create();

        $this->getJson(route("api.v1.customers.index"))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(["data" => [["first_name" => $customer1["first_name"]],["first_name" => $customer2["first_name"]]]]);
    }
}
