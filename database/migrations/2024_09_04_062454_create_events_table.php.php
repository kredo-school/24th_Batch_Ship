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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('host_id');
            $table->unsignedBigInteger('community_id');
            $table->string('title', 255);
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('address', 255);
            $table->string('price', 255);
            $table->text('description');
            $table->longText('image');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('host_id')->references('id')->on('users');
            $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};