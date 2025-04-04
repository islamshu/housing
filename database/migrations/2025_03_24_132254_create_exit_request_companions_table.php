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
        Schema::create('exit_request_companions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exit_request_id');
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();
        
            $table->foreign('exit_request_id')->references('id')->on('exit_requests')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exit_request_companions');
    }
};
