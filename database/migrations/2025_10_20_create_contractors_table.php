<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('constractor_name');
            $table->string('vendor_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes(); // <-- This will add a deleted_at field
        });
    }
    public function down(): void {
        Schema::dropIfExists('contractors');
    }
};
