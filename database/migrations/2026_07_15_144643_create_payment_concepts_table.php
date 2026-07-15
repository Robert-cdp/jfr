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
        Schema::create('payment_concepts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('institution_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->text('description')->nullable();

            $table->decimal('default_amount', 10, 2);

            $table->boolean('is_monthly')->default(false);

            $table->boolean('allow_partial_payments')->default(true);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_concepts');
    }
};
