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
            $table->string('slug')->unique();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('identity_number',11);
            $table->string('cell_phone',11);
            $table->string('profile_image')->nullable();
            $table->text('address')->nullable();

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
