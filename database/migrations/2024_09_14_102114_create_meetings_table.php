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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_name');
            $table->string('meeting_location');
            $table->dateTime('meeting_from');
            $table->dateTime('meeting_to');
            $table->string('meeting_host');
            $table->string('meeting_participants');
            $table->string('meeting_participants_id');
            $table->string('meeting_related_to');
            $table->string('meeting_status')->default("Waiting");
            $table->string('meeting_reminder');
            $table->string('meeting_reminder_status')->default('false');
            $table->integer('meeting_creator_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
