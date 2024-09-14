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
            $table->date('meeting_from');
            $table->date('meeting_to');
            $table->string('meeting_host');
            $table->string('meeting_participants');
            $table->integer('meeting_related_to');
            $table->integer('meeting_related_to_value');
            $table->string('meeting_status');
            $table->dateTime('meeting_reminder');

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
