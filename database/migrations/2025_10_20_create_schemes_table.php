<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Scheme Name');
            $table->string('adp_code')->comment('ADP Number from ADP table');
            $table->foreignIdFor(\App\Models\ADP::class)->constrained()->cascadeOnDelete();
            $table->decimal('sub_work_t_s_cost', 15, 2)->comment('Bid cost Plus 15% of increase');
            $table->decimal('expenditure', 15, 2)->comment('Expenditure');
            $table->decimal('liability', 15, 2)->comment('Target Liability');
            $table->decimal('physical_progress', 15, 2)->comment('physical progress work done physically');
            $table->decimal('financial_progress', 15, 2)->comment('paid amount of T.S cost');
            $table->foreignId('contractor_id')->nullable()->constrained('contractors')->nullOnDelete();
            $table->decimal('contractor_premium', 10, 2)->nullable();
            $table->decimal('bid_cost', 15, 2)->nullable();
            $table->string('agreement_no')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes(); // <-- This will add a deleted_at field
        });
    }
    public function down(): void { Schema::dropIfExists('schemes'); }
};
