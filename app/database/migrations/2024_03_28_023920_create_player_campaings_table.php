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
        Schema::create('player_campaings', function (Blueprint $table) {
            $table->uuid('player_uuid');
            $table->uuid('campaing_uuid');
            $table->enum('request_status', ['pending', 'accepted', 'refused'])->default('pending');
            $table->timestamps();

            $table->primary(['player_uuid', 'campaing_uuid']);
            $table->foreign('player_uuid')->references('uuid')->on('players')->cascadeOnDelete();
            $table->foreign('campaing_uuid')->references('uuid')->on('campaings')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_campaings');
    }
};
