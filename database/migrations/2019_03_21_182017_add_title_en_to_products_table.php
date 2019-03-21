<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleEnToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('short_description_en')->nullable()->after('short_description');
            $table->string('description_en')->nullable()->after('description');
            $table->string('vitigno_en')->nullable()->after('vitigno');
            $table->string('zona_en')->nullable()->after('zona');
            $table->string('vinificazione_en')->nullable()->after('vinificazione');
            $table->string('valori_analitici_en')->nullable()->after('valori_analitici');
            $table->string('scheda_tecnica_en')->nullable()->after('scheda_tecnica');
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
            $table->dropColumn('title_en');
            $table->dropColumn('short_description_en');
            $table->dropColumn('description_en');
            $table->dropColumn('vitigno_en');
            $table->dropColumn('zona_en');
            $table->dropColumn('vinificazione_en');
            $table->dropColumn('valori_analitici_en');
            $table->dropColumn('scheda_tecnica_en');
        });
    }
}
