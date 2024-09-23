<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->after('id'); 
        });
    }
    
    public function down()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropForeign(['category_id']); 
            $table->dropColumn('category_id'); 
        });
    }
    
    
};
