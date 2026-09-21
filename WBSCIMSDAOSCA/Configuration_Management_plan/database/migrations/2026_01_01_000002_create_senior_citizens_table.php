<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('senior_citizens', function (Blueprint $table) {
            $table->id();
            $table->string('osca_id')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('birth_date');
            $table->enum('sex', ['Male','Female','Other']);
            $table->enum('civil_status', ['Single','Married','Widowed','Separated','Divorced']);
            $table->string('barangay');
            $table->string('address');
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pension_type')->nullable();
            $table->boolean('pension_enrolled')->default(false);
            $table->uuid('qr_token')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['barangay','is_active']);
            $table->index('pension_enrolled');
        });
    }

    public function down(): void { Schema::dropIfExists('senior_citizens'); }
};