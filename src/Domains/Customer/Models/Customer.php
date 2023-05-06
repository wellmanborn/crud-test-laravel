<?php

declare(strict_types=1);

namespace Src\Domains\Customer\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Src\Domains\Shared\Models\Concerns\HasKey;

class Customer extends Model
{
    use HasKey;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["first_name", "last_name", "email", "phone_number", "date_of_birth", "bank_account_number"];

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strval($value),
        );
    }

    protected static function newFactory(): Factory
    {
        return CustomerFactory::new();
    }

}
