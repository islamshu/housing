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
        Schema::create('exit_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('room_id');
            $table->enum('type', ['daily', 'overnight']);
            $table->datetime('exit_time');
            $table->datetime('expected_return_time');
            $table->datetime('actual_return_time')->nullable();
            $table->string('destination');
            $table->enum('transport', ['regular', 'app']);
            $table->string('taxi_number')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->foreign('employee_id')
            ->references('id')
            ->on('employees')
            ->onDelete('cascade');
            
      $table->foreign('room_id')
            ->references('id')
            ->on('rooms')
            ->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exit_requests');
    }
};
