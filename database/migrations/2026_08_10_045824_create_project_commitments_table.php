<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_commitments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('project_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Example: 2026-08
            $table->string('commitment_month');

            $table->decimal('actual', 5, 2)->nullable();
            $table->decimal('planned', 5, 2)->nullable();
            $table->decimal('slippage', 5, 2)->nullable();

            $table->decimal('advance_payment', 15, 2)->nullable();
            $table->decimal('progress_interim', 15, 2)->nullable();

            $table->timestamps();

            // Prevent duplicate records for the same month
            $table->unique(['project_id', 'commitment_month']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_commitments');
    }
};