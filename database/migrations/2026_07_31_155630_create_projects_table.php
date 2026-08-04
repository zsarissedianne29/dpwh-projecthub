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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('project_id')->unique();
            $table->text('project_title');
            $table->decimal('contract_amount', 15, 2)->default(0);
            $table->string('contractor')->nullable();
            $table->string('project_engineer')->nullable();
            $table->text('location')->nullable();

            $table->enum('status', ['ongoing', 'completed', 'suspended'])
                  ->default('ongoing');

            $table->decimal('slippage', 5, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('target_completion')->nullable();

            $table->decimal('actual_completion', 5, 2)->default(0);
            $table->decimal('physical_accomplishment', 5, 2)->default(0);
            $table->decimal('financial_accomplishment', 5, 2)->default(0);

            // Coordinates for Project Map
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};