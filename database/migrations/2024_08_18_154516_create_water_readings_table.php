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
        Schema::create('water_readings', function (Blueprint $table) {
            $table->id();
            $table->decimal('previous_reading', 10, 2)
                ->nullable()
                ->default(0.00);
            $table->decimal('current_reading', 10, 2);
            $table->date('reading_date');
            $table->decimal('cost_per_unit', 10, 2);
            $table->decimal('consumption', 10, 2);
            $table->decimal('total_cost', 10, 2);
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

            $table->foreignUuid('recorded_by')
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
        Schema::dropIfExists('water_readings');
    }
};
