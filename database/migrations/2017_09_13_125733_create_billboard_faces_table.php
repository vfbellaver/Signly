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

            $table->string('unique_id', 6);
            $table->float('height', 10, 0)->default(0);
            $table->float('width', 10, 0)->default(0);
            $table->string('reads', 50);
            $table->string('label', 50);
            $table->boolean('sign_type')->default(0)->comment('0 for static 1 for digital');
            $table->float('hard_cost', 10, 0)->default(0);
            $table->float('monthly_impressions', 10, 0)->default(0);
            $table->text('notes');
            $table->integer('max_ads');
            $table->integer('duration');
            $table->text('photo');
            $table->boolean('is_iluminated')->default(false);
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
