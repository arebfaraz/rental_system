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
        Schema::create('water_bill_invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('status')->index()->default(\App\Enums\PaymentStatusEnum::PENDING->value);
            $table->text('notes')->nullable();
            $table->foreignId('water_reading_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignUuid('property_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('house_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('tenant_id')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_bill_invoices');
    }
};
