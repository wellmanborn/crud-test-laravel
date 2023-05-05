<?php

namespace App\Http\Requests;

use App\Rules\MobileNumber;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        return [
            "first_name" => ["required", "max:50"],
            "last_name" => ["required", "max:50"],
            "email" => ["required", "max:100", "email", "unique:customers,email"],
            "phone_number" => ['required', new MobileNumber()],
            "date_of_birth" => [
                "required",
                "date:format(Y-m-d)",
                Rule::unique('customers')->where(function ($query) use ($request) {
                    return $query->where('date_of_birth', $request->get("date_of_birth"))
                                ->where('first_name', $request->get("first_name"))
                                ->where('last_name', $request->get("last_name"));
                })
            ],
            "bank_account_number" => ["required", "max:20"]
        ];
    }

    public function messages(): array
    {
        return [
            'date_of_birth.unique' => 'Combination of date of birth & first name & host name is not unique',
        ];
    }
}
