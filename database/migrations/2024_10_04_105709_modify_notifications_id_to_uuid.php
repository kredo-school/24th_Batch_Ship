<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNotificationsIdToUuid extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Change the id column to UUID
            $table->uuid('id')->change();
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Revert the id column back to auto-increment integer
            $table->increments('id')->change();
        });
    }
};