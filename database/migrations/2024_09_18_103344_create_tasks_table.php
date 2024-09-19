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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_owner');
            $table->string('subject');
            $table->dateTime('due_date');
            $table->string('group');
            $table->string('person_of_group');
            $table->string('related_to');
            $table->string('status')->default('Not-Started');
            $table->string('priority');
            $table->longText('description')->nullable();
            $table->string('reminder')->default('false');
            $table->string('reminder_send')->default('false');
            $table->dateTime('reminder_time')->nullable();
            $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
