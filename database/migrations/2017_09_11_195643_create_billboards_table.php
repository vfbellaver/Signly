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
            $table->string('slugname',128);
            $table->string('address', 256);
            $table->decimal('lat', 18, 15);
            $table->decimal('lng', 18, 15);
            $table->decimal('heading', 18, 14)->nullable();
            $table->decimal('pitch', 18, 14)->nullable();
            $table->text('description')->nullable();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedInteger('team_id');
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billboards');
    }
}
