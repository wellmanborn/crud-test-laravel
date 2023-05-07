<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Contracts\View\View;
use Src\Domains\Customer\Commands\CreateCustomer;
use Src\Domains\Customer\Commands\DestroyCustomer;
use Src\Domains\Customer\Commands\UpdateCustomer;
use Src\Domains\Customer\DTO\CustomerDto;
use Src\Domains\Customer\Models\Customer;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{

    public function index(): View
    {
        $customers = Customer::paginate(10);

        return view("customers.index", compact("customers"));
    }

    public function show(Customer $customer): View
    {
        return view("customers.show", compact("customer"));
    }

    public function edit(Customer $customer): View
    {
        return view("customers.edit", compact("customer"));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        UpdateCustomer::handle(CustomerDto::update($request->validated(), $customer), $customer);
        return redirect()->route("customers.index")->with("success", "Successfully Updated");
    }

    public function create(): View
    {
        return view("customers.create");
    }

    public function store(CreateCustomerRequest $request): RedirectResponse
    {
        CreateCustomer::handle(
            CustomerDto::create($request->validated())
        );
        return redirect()->route("customers.index")->with("success", "Successfully Created");
    }

    public function delete(Customer $customer): RedirectResponse
    {
        DestroyCustomer::handle($customer);
        return redirect()->route("customers.index")->with("success", "Successfully Deleted");
    }
}
