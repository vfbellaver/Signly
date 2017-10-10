<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillboardFacesTable extends Migration
{
    public function up()
    {
        Schema::create('billboard_faces', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 6);
            $table->string('label', 50);
            $table->float('hard_cost', 10, 0)->default(0);
            $table->float('monthly_impressions', 10, 0)->default(0);
            $table->integer('duration');
            $table->boolean('is_illuminated')->default(false);

            $table->float('height', 10)->nullable();
            $table->float('width', 10)->nullable();
            $table->string('reads', 50)->nullable();
            $table->text('notes')->nullable();
            $table->integer('max_ads')->nullable();
            $table->text('photo')->nullable();
            $table->string('type',50)->nullable();
            $table->string('lights_on')->nullable();
            $table->string('lights_off')->nullable();

            $table->unsignedInteger('billboard_id');
            $table->foreign('billboard_id')
                ->references('id')
                ->on('billboards')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billboard_faces');
    }
}
