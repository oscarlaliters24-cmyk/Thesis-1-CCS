<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('senior_citizen_id')->constrained()->cascadeOnDelete();
            $table->string('benefit_type');
            $table->decimal('amount', 12, 2)->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->enum('status', ['pending','claimed','cancelled'])->default('pending');
            $table->text('remarks')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->index(['status','claimed_at']);
        });
    }

    public function down(): void { Schema::dropIfExists('benefits'); }
};