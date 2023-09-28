<?php

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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->required(); // First name (required)
            $table->string('last_name')->required(); // Last name (required)
            $table->unsignedBigInteger('company_id'); // Company (foreign key referencing the "companies" table)
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('email')->nullable(); // Email
            $table->string('phone')->nullable(); // Phone
            $table->string('profile_picture')->nullable(); // Profile Picture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
