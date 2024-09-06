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
        Schema::create('manage_module_link', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('principal_xid');
            $table->foreign('principal_xid')->references('id')->on('iam_principal')->onDelete('cascade');
            $table->unsignedBigInteger('manage_modules_xid');
            $table->foreign('manage_modules_xid')->references('id')->on('manage_module')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_module_link');
    }
};
