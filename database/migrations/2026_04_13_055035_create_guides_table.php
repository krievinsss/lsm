<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->unsignedTinyInteger('channel_nr');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->timestamps();

            $table->index(['channel_nr', 'starts_at']);
            $table->index(['channel_nr', 'ends_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guides');
    }
};