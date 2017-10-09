<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (BluePrint $table) {
            $table->increments('id');
            $table->string('company_name', 128);
            $table->string('logo', 256)->nullable();
            $table->string('first_name', 64)->nullable();
            $table->string('last_name', 64)->nullable();
            $table->string('email', 128)->nullable();
            $table->string('address_line1', 64)->nullable();
            $table->string('address_line2', 64)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('zipcode', 13)->nullable();
            $table->string('state', 64)->nullable();
            $table->string('phone1', 24)->nullable();
            $table->string('phone2', 24)->nullable();
            $table->string('fax', 24)->nullable();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
