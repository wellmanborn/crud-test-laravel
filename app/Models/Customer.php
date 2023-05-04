<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = ["first_name", "last_name", "email", "phone_number", "date_of_birth", "bank_account_number"];

}
