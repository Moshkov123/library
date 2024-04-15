<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Inside the migration file for the users table
public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        // Adjust the data type of role_id to match the primary key in the roles table
        $table->unsignedBigInteger('role_id')->default(2); // Assuming the primary key in the roles table is an unsigned big integer
        $table->foreign('role_id')->references('id')->on('roles');
        $table->rememberToken();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
