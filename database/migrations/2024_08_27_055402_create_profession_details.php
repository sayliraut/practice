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
        Schema::create('profession_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('principal_xid');
            $table->foreign('principal_xid')->references('id')->on('iam_principal')->onDelete('cascade');
            $table->enum('profession', ['Salaried', 'Self-employed']);
            $table->string('company_name')->nullable();
            $table->date('job_started_from')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_location')->nullable();
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
        Schema::dropIfExists('profession_details');
    }
};
