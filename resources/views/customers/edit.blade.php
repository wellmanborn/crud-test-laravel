@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="post" action="{{ route("customers.update", $customer->id) }}">
                    @method("PUT")
                    @csrf
                    <div class="card">
                        <div class="card-header">{{ __('Customer') }} - {{ $customer->full_name }}</div>
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
                                           value="{{ $customer->first_name }}" id="first_name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-5">
                                    <input name="last_name" type="text" class="form-control"
                                           value="{{ $customer->last_name }}" id="last_name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-5">
                                    <input name="email" type="text" class="form-control"
                                           value="{{ $customer->email }}" id="email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-5">
                                    <input name="phone_number" type="text" class="form-control"
                                           value="+{{ $customer->phone_number }}" id="phone_number">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="date_of_birth" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-5">
                                    <input name="date_of_birth" type="text" class="form-control"
                                           value="{{ $customer->date_of_birth }}" id="date_of_birth">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="bank_account_number" class="col-sm-2 col-form-label">Bank Account
                                    Number</label>
                                <div class="col-sm-5">
                                    <input name="bank_account_number" type="text" class="form-control"
                                           value="{{ $customer->bank_account_number }}" id="bank_account_number">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="Submit">Edit Customer</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
