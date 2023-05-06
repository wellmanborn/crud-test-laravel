<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\MobileNumber;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
            "first_name" => ["max:50"],
            "last_name" => ["max:50"],
            "email" => ["max:100", "email", "unique:customers,email," . $this->customer->id],
            "phone_number" => [new MobileNumber()],
            "date_of_birth" => [
                "date:format(Y-m-d)",
                Rule::unique('customers')->where(function ($query) use ($request) {
                    return $query->where('date_of_birth', $request->get("date_of_birth"))
                                ->where('first_name', $request->get("first_name"))
                                ->where('last_name', $request->get("last_name"));
                })->ignore($this->customer->id)
            ],
            "bank_account_number" => ["max:20"]
        ];
    }

    public function messages(): array
    {
        return [
            'date_of_birth.unique' => 'Combination of date of birth & first name & host name is not unique',
        ];
    }
}
