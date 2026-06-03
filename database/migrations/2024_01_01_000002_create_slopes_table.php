<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slopes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced', 'expert']);
            $table->integer('length')->comment('длина в метрах');
            $table->integer('elevation')->comment('перепад высот');
            $table->enum('status', ['open', 'closed', 'maintenance'])->default('open');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slopes');
    }
};