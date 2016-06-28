<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SentinelAdditionalColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('slug')->unique()->change();
            $table->string('email')->unique();
            $table->integer('identity_number');
            $table->integer('cell_phone');
            $table->string('profile_image');
            $table->text('address')->nullable();
            $table->integer('city_id')->unsigned()->nullable();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
