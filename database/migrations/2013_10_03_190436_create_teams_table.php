<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('teams', function (BluePrint $table) {
            $table->increments('id');

            $table->string('name', 64);

            $table->string('email', 128)->unique();
            $table->string('phone', 24)->nullable();
            $table->string('fax', 24)->nullable();

            $table->string('logo', 128)->nullable();
            $table->string('slug', 100)->unique();

            $table->string('address_line1', 64)->nullable();
            $table->string('address_line2', 64)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('zipcode', 13)->nullable();
            $table->string('state', 64)->nullable();

            $table->string('phone1', 24)->nullable();
            $table->string('phone2', 24)->nullable();
            $table->string('fax', 24)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
