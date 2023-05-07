<?php

declare(strict_types=1);

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateCustomerWebTest extends TestCase
{
    use DatabaseMigrations;

    protected Customer $customer;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->customer = Customer::factory()->make();
    }

    public function test_a_client_can_create_customer_via_web(): void
    {
        $this->withoutExceptionHandling();
        $this->post(route("customers.store"), $this->customer->toArray())
            ->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas(Customer::class, $this->customer->toArray());
    }

    public function test_a_client_cannot_create_customer_without_email_via_web(): void
    {

        $this->post(route("customers.store"), [...$this->customer->toArray(), "email" => null])
            ->assertSessionHasErrors(["email"]);
    }

    public function test_a_client_cannot_create_customer_with_invalid_email_via_web() : void
    {
        $this->post(route("customers.store"), [...$this->customer->toArray(), "email" => "invalid"])
            ->assertSessionHasErrors(["email"]);
    }

    public function test_a_client_cannot_create_customer_with_duplicate_email_via_web(): void
    {
        Customer::factory()->create(["email" => "test@email.com"]);

        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "email" => "test@email.com"])
            ->assertSessionHasErrors(["email"]);
    }

    public function test_a_client_cannot_create_customer_without_first_name_via_web(): void
    {
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "first_name" => null])
            ->assertSessionHasErrors(["first_name"]);
    }

    public function test_a_client_cannot_create_customer_without_last_name_via_web(): void
    {
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "last_name" => null])
            ->assertSessionHasErrors(["last_name"]);
    }

    public function test_a_client_cannot_create_customer_without_phone_number_via_web(): void
    {
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "phone_number" => null])
            ->assertSessionHasErrors(["phone_number"]);
    }

    public function test_a_client_cannot_create_customer_with_invalid_phone_number_via_web(): void
    {
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "phone_number" => "123456789"])
            ->assertSessionHasErrors(["phone_number"]);
    }

    public function test_a_client_cannot_create_customer_without_date_of_birth_via_web(): void
    {
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "date_of_birth" => null])
            ->assertSessionHasErrors(["date_of_birth"]);
    }

    public function test_a_client_cannot_create_customer_with_invalid_date_via_web(): void
    {
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "date_of_birth" => "1985/22/15"])
            ->assertSessionHasErrors(["date_of_birth"]);
    }

    public function test_a_client_cannot_create_customer_without_bank_account_number_via_web(): void
    {
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(), "bank_account_number" => null])
            ->assertSessionHasErrors(["bank_account_number"]);
    }

    public function test_a_client_cannot_create_customer_with_same_first_name_and_last_name_and_date_of_birth_via_web(): void
    {
        $customer = Customer::factory()->create()->toArray();
        $this->post(route("api.v1.customers.store"), [...$this->customer->toArray(),
                "first_name" => $customer["first_name"],
                "last_name" => $customer["last_name"],
                "date_of_birth" => $customer["date_of_birth"],
            ])
            ->assertSessionHasErrors(["date_of_birth"]);
    }
}
