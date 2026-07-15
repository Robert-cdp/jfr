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
        Schema::create('receipt_sequences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('institution_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('prefix')->default('REC');

            $table->unsignedBigInteger('current_number')->default(0);

            $table->unsignedTinyInteger('padding')->default(6);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_sequences');
    }
};
