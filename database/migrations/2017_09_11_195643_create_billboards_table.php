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
            $table->string('address', 256);
            $table->decimal('lat', 18, 15);
            $table->decimal('lng', 18, 15);
            $table->text('description')->nullable();
            $table->string('digital_driveby', 128)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billboards');
    }
}
