<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('personal_no')->nullable();
            $table->string('cnic')->nullable();
            $table->string('duty_station')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes(); // <-- This will add a deleted_at field
        });
    }
    public function down(): void { Schema::dropIfExists('portfolios'); }
};
