<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (BluePrint $table) {
            $table->increments('id');
            $table->string('company_name',128);
            $table->string('logo',256)->nullable();
            $table->string('first_name',64)->nullable();
            $table->string('last_name',64)->nullable();
            $table->string('email',128)->nullable();
            $table->string('address_line1',64)->nullable();
            $table->string('address_line2',64)->nullable();
            $table->string('city',64)->nullable();
            $table->string('zipcode',8)->nullable();
            $table->string('state',64)->nullable();
            $table->string('phone1',14)->nullable();
            $table->string('phone2',14)->nullable();
            $table->string('fax',14)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
