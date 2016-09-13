<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetLists extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fleet_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->
                    references('id')->on('users')->onDelete('SET NULL');
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->
                    references('id')->on('groups')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('fleet_lists');
    }

}
