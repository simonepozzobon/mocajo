<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('stripe_id')->unique();
            $table->integer('category');
            $table->string('company_name')->nullable();
            $table->string('vat')->nullable();
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->string('country');
            $table->string('region');
            $table->string('city');
            $table->string('cap');
            $table->string('address');
            $table->string('card_id')->nullable();
            $table->string('address_secondary')->nullable();
            $table->boolean('captcha_validated')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
