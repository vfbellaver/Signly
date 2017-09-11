<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillboardsTable extends Migration
{
    public function up()
    {
        Schema::create('billboards', function (BluePrint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->text('address');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billboards');
    }
}
