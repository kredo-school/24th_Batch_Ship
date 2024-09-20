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
       
            Schema::table('posts', function (Blueprint $table) {
                $table->text('description')->nullable()->change();
                $table->longText('image')->nullable()->change();

                });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
            Schema::table('posts', function (Blueprint $table) {
                $table->text('description')->nullable(false)->change();
                $table->longText('image')->nullable(false)->change();
                 });
        
    }
};
