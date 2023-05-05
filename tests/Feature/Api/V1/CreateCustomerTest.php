<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1;

use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
    use DatabaseMigrations;

    protected Customer $customer;
    protected CreateCustomerTest $request;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->customer = Customer::factory()->make();
    }

    public function test_a_client_can_create_customer(): void
    {
        $this->postJson(route("api.v1.customers.store"), $this->customer->toArray())
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_a_client_cannot_create_customer_without_email(): void
    {

        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "email" => null])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["email" => []]]);
    }

    public function test_a_client_cannot_create_customer_with_invalid_email() : void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "email" => "invalid"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["email" => []]]);
    }

    public function test_a_client_cannot_create_customer_with_duplicate_email(): void
    {
        Customer::factory()->create(["email" => "test@email.com"]);

        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "email" => "test@email.com"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["email" => []]]);
    }

    public function test_a_client_cannot_create_customer_without_first_name(): void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "first_name" => null])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["first_name" => []]]);
    }

    public function test_a_client_cannot_create_customer_without_last_name(): void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "last_name" => null])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["last_name" => []]]);
    }

    public function test_a_client_cannot_create_customer_without_phone_number(): void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "phone_number" => null])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["phone_number" => []]]);
    }

    public function test_a_client_cannot_create_customer_with_invalid_phone_number(): void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "phone_number" => "123456789"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["phone_number" => []]]);
    }

    public function test_a_client_cannot_create_customer_without_date_of_birth(): void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "date_of_birth" => null])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["date_of_birth" => []]]);
    }

    public function test_a_client_cannot_create_customer_with_invalid_date(): void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "date_of_birth" => "1985/22/15"])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["date_of_birth" => []]]);
    }

    public function test_a_client_cannot_create_customer_without_bank_account_number(): void
    {
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(), "bank_account_number" => null])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["bank_account_number" => []]]);
    }

    public function test_a_client_cannot_create_customer_with_same_first_name_and_last_name_and_date_of_birth(): void
    {
        $customer = Customer::factory()->create()->toArray();
        $this->postJson(route("api.v1.customers.store"), [...$this->customer->toArray(),
                "first_name" => $customer["first_name"],
                "last_name" => $customer["last_name"],
                "date_of_birth" => $customer["date_of_birth"],
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(["errors" => ["date_of_birth" => []]]);
    }
}
