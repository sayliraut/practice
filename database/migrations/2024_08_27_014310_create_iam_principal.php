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
        Schema::create('iam_principal', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->bigInteger('state_xid')->nullable();
            $table->bigInteger('city_xid')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('email_address', 50)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iam_principal');
    }
};
