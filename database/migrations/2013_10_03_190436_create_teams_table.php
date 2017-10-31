<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('teams', function (BluePrint $table) {
            $table->increments('id');
            $table->string('name', 60)->unique();
            $table->string('logo', 128)->nullable();
            $table->string('slug', 100)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
