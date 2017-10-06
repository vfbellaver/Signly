<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillboardFacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboard_faces', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 6)->unique();
            $table->float('height', 10)->nullable();
            $table->float('width', 10)->nullable();
            $table->string('reads', 50)->nullable();
            $table->string('label', 50);
            $table->float('hard_cost', 10, 0)->default(0);
            $table->float('monthly_impressions', 10, 0)->default(0);
            $table->text('notes')->nullable();
            $table->integer('max_ads')->nullable();
            $table->integer('duration');
            $table->text('photo');
            $table->boolean('is_illuminated')->default(false);
            $table->time('lights_on')->nullable();
            $table->time('lights_off')->nullable();
            $table->integer('billboard_id')->unsigned()->nullable();

            $table->foreign('billboard_id')->references('id')->on('billboards')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billboard_faces');
    }
}
