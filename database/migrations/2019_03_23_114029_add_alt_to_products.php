<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAltToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('alt')->default('null');
            $table->string('alt_en')->default('null');
            $table->string('image_title')->default('null');
            $table->string('image_title_en')->default('null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('alt');
            $table->dropColumn('alt_en');
            $table->dropColumn('image_title');
            $table->dropColumn('image_title_en');
        });
    }
}
