<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1\Customers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DestroyCustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_client_can_delete_customer(): void
    {

        $customer = Customer::factory()->create();

        $this->deleteJson(route("api.v1.customers.destroy", $customer->key))
            ->assertStatus(Response::HTTP_OK);

        $this->assertSoftDeleted(Customer::class, $customer->toArray());
    }
}
