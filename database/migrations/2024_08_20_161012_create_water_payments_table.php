<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('water_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('amount', 16, 2);
            $table->dateTime('paid_at')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('payment_receipt')->nullable();

            $table->foreignId('water_bill_invoice_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('tenant_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignUuid('recorded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_payments');
    }
};
