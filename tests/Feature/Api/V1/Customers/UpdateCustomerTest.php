<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1\Customers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCustomerTest extends TestCase
{
    use DatabaseMigrations;

    protected Customer $customer;
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->customer = Customer::factory()->make();
    }

    public function test_a_client_can_update_customer(): void
    {
        $customer = Customer::factory()->create();
        $this->putJson(route("api.v1.customers.update", $customer->key), $this->customer->toArray())
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas(Customer::class, $this->customer->toArray());
    }

    public function test_a_client_can_update_a_specific_part_of_customer(): void
    {
        $customer = Customer::factory()->create();
        $this->putJson(route("api.v1.customers.update", $customer->key), ["first_name" => "TestJohn"])
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas(Customer::class, [...$customer->toArray(), "first_name" => "TestJohn"]);
    }

    public function test_a_client_cannot_update_customer_with_invalid_email(): void
    {
        $customer = Customer::factory()->create();
        $this->putJson(route("api.v1.customers.update", $customer->key), [...$customer->toArray(), "email" => "invalid"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["email" => []]]);
    }

    public function test_a_client_cannot_update_customer_with_duplicate_email_but_itself(): void
    {
        $customer = Customer::factory()->create(["email" => "test@email.com"]);

        $this->putJson(route("api.v1.customers.update", $customer->key), [...$this->customer->toArray(),
            "email" => "test@email.com"])
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas(Customer::class, [...$this->customer->toArray(),
            "email" => "test@email.com"]);

        $customer2 = Customer::factory()->create();

        $this->putJson(route("api.v1.customers.update", $customer2->key), [...$this->customer->toArray(),
            "email" => "test@email.com"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["email" => []]]);
    }

    public function test_a_client_cannot_update_customer_with_invalid_phone_number(): void
    {
        $customer = Customer::factory()->create();
        $this->putJson(route("api.v1.customers.update", $customer->key),
            [...$this->customer->toArray(), "phone_number" => "123456789"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["phone_number" => []]]);
    }

    public function test_a_client_cannot_update_customer_with_invalid_date(): void
    {
        $customer = Customer::factory()->create();
        $this->putJson(route("api.v1.customers.update", $customer->key),
            [...$this->customer->toArray(), "date_of_birth" => "1985/22/15"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["date_of_birth" => []]]);
    }

    public function test_a_client_cannot_update_customer_with_same_first_name_and_last_name_and_date_of_birth_but_itself(): void
    {
        $data = ["first_name" => "John", "last_name" => "Doe", "date_of_birth" => "1985-10-31"];
        $customer = Customer::factory()->create($data);

        $this->putJson(route("api.v1.customers.update", $customer->key), [...$this->customer->toArray(), ...$data])
            ->assertStatus(Response::HTTP_OK);

        $customer2 = Customer::factory()->create();

        $this->putJson(route("api.v1.customers.update", $customer2->key), ["email" => "x@fmail.com", ...$data])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["date_of_birth" => []]]);
    }
}
