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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('Message');
            $table->foreignId('meeting_id')->constrained('meetings')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('is_attended')->default('false');
            $table->string('end_meeting_status')->default('false');
            $table->string('end_meeting_permission')->default('no-permission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
