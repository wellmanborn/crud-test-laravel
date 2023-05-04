<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid("key")->unique();

            $table->string("first_name", 50);
            $table->string("last_name", 50);
            $table->string("email", 100)->unique();
            $table->unsignedBigInteger("phone_number");
            $table->date("date_of_birth");
            $table->string("bank_account_number", 20);

            $table->softDeletes();

            $table->timestamps();

            $table->unique(["first_name", "last_name", "date_of_birth"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
