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
        Schema::create('subadmin_contact_admins', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->string('contact_admin_response')->nullable();
            $table->boolean('is_admin_response')->default(0);
            $table->boolean('is_subadmin_response')->default(0);
            $table->string('subadmin_response')->nullable();
            $table->boolean('is_active')->default(1)->comment('1=Active, 0=Expired');
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subadmin_contact_admins');
    }
};
