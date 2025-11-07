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
        Schema::create('adps', function (Blueprint $table) {
            $table->id();
            $table->string('adp_code')->unique()->comment('ADP Number');
            $table->string('allocation')->comment('Per Year Budget Allocation');
            $table->string('adp_t_s_cost')->comment('Bid cost Plus 15% of increase');
            $table->string('total_expenditure')->comment('Total Expenditure')->nullable();
            $table->string('accured_liability')->comment('After paid the remaining ammont = total ammount- paid ammount')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('remarks')->nullable();
            $table->string('attached_files')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes(); // <-- This will add a deleted_at field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adps');
    }
};
