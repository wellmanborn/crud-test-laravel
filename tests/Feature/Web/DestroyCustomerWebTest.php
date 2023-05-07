<?php

declare(strict_types=1);

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DestroyCustomerWebTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_client_can_delete_customer_via_web(): void
    {

        $customer = Customer::factory()->create();

        $this->delete(route("customers.delete", $customer->id))
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertSoftDeleted(Customer::class, $customer->toArray());
    }
}
