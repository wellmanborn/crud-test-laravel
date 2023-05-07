@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="post" action="{{ route("customers.store") }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">{{ __('Create New Customer') }}</div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        {!!  implode('', $errors->all('<li>:message</li>')) !!}
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3 row">
                                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-5">
                                    <input name="first_name" type="text" class="form-control"
                                           value="{{ old("first_name") }}" placeholder="Insert First Name"
                                           id="first_name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-5">
                                    <input name="last_name" type="text" class="form-control"
                                           value="{{ old("last_name") }}" placeholder="Insert Last Name" id="last_name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-5">
                                    <input name="email" type="text" class="form-control"
                                           value="{{ old("email") }}" placeholder="Insert Email: user@eample.com"
                                           id="email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-5">
                                    <input name="phone_number" type="text" class="form-control"
                                           value="{{ old("phone_number") }}" placeholder="Mobile number: +989123456789"
                                           id="phone_number">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="date_of_birth" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-5">
                                    <input name="date_of_birth" type="text" class="form-control"
                                           value="{{ old("date_of_birth") }}" placeholder="Date of Birth: 1985-02-18"
                                           id="date_of_birth"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="bank_account_number" class="col-sm-2 col-form-label">Bank Account
                                    Number</label>
                                <div class="col-sm-5">
                                    <input name="bank_account_number" type="text" class="form-control"
                                           value="{{ old("bank_account_number") }}" placeholder="Bank Account Number"
                                           id="bank_account_number">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="create_customer" class="btn btn-primary" type="Submit">Create Customer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
