<?php

declare(strict_types=1);

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Domains\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexCustomerWebTest extends TestCase
{
    use DatabaseMigrations;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function test_a_client_see_all_customers_via_web(): void
    {
        $customer1 = Customer::factory()->create();

        $this->get(route("customers.index"))
            ->assertStatus(Response::HTTP_OK)
            ->assertSee($customer1["first_name"]);
    }
}
