<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('nocs', function (Blueprint $table) {
            $table->id();
            $table->string('issue_no')->unique();
            $table->string('department')->nullable();
            $table->text('noc_subject')->nullable();
            $table->text('nature_of_noc')->nullable();
            $table->text('remarks')->nullable();
            $table->text('differed')->nullable();
            $table->date('issued_date')->nullable();
            $table->string('attachment')->nullable();
            $table->tinyInteger('nocstatus')->default(1)->comment('NOC status Approved or reject');
            $table->tinyInteger('filestatus')->default(1)->comment('File Status means file position');
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes(); // <-- This will add a deleted_at field
        });
    }
    public function down(): void { Schema::dropIfExists('nocs'); }
};
