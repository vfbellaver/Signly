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
            $table->decimal('heading', 18, 14)->nullable();
            $table->decimal('pitch', 16, 15)->nullable();
            $table->text('description')->nullable();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billboards');
    }
}
