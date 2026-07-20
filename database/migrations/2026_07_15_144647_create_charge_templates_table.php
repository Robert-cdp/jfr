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
        Schema::create('charge_templates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_year_id')->constrained()->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payment_concept_id')->constrained()->cascadeOnDelete();

            $table->decimal('amount', 10, 2);

            $table->enum('frequency', [
                'monthly',
                'one_time',
            ]);

            $table->unsignedTinyInteger('months')->nullable();

            $table->unsignedTinyInteger('start_month')->nullable();

            $table->unsignedTinyInteger('payment_day')->nullable();

            $table->unsignedTinyInteger('event_month')->nullable();

            $table->unsignedTinyInteger('installments')->default(1);
            
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charge_templates');
    }
};
