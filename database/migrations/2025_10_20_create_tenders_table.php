<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_id')->constrained('schemes')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->string('attached_files')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes(); // <-- This will add a deleted_at field
        });
    }
    public function down(): void { Schema::dropIfExists('tenders'); }
};
