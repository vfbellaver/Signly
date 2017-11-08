<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillboardsTable extends Migration
{
    public function up()
    {
        Schema::create('billboards', function (BluePrint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id');

            $table->string('name', 128);
            $table->string('slug', 190);
            $table->string('address', 256);
            $table->decimal('lat', 18, 15);
            $table->decimal('lng', 18, 15);
            $table->decimal('heading', 18, 14)->nullable();
            $table->decimal('pitch', 18, 14)->nullable();
            $table->text('description')->nullable();

            $table->unique(['team_id', 'slug']);

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
