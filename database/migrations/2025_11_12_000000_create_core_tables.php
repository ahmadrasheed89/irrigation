<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(){
        Schema::create('departments', function(Blueprint $t)
        {
            $t->id();
            $t->string('name');
            $t->timestamps();
            $t->softDeletes(); // <-- This will add a deleted_at field

        });
        Schema::create('positions', function(Blueprint $t)
        {
            $t->id();
            $t->string('name');
            $t->string('detail')->nullable();
            $t->timestamps();
            $t->softDeletes(); // <-- This will add a deleted_at field

        });
        Schema::create('tasks', function(Blueprint $t){
            $t->id();
            $t->string('title');
            $t->text('description')->nullable();
            $t->string('status')->default('todo');
            $t->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $t->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $t->integer('priority')->default(1);
            $t->date('due_date')->nullable();
            $t->string('color')->nullable()->default('#e9ecef'); // optional color per tag
            $t->boolean('is_archived')->default(0);
            $t->timestamps();
            $t->softDeletes(); // <-- This will add a deleted_at field

        });
    }
    public function down(){
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('departments');
    }
};
