<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompatibilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('compatibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ユーザーID
            $table->foreignId('send_user_id')->constrained('users')->onDelete('cascade'); // 送信ユーザーID
            $table->integer('compatibility');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compatibilities');
    }


};
