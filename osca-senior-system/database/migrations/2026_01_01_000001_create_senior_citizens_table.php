<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('senior_citizens', function (Blueprint $table) {
            $table->id();
            $table->string('senior_id')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('sex',['Male','Female']);
            $table->string('address');
            $table->string('barangay');
            $table->enum('pension_status',['Yes','No'])->default('No');
            $table->enum('philhealth_status',['Yes','No'])->default('No');
            $table->string('qr_code',64)->unique();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('senior_citizens'); }
};
