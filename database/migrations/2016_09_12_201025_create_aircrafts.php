<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircrafts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircrafts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model')->default('');
            $table->integer('year')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->integer('fleet_list_id')->unsigned();
            $table->foreign('fleet_list_id')->
                    references('id')->on('fleet_lists')->onDelete('RESTRICT');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->
                    references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('aircrafts');
    }
}
