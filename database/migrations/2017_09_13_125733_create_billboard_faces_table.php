<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillboardFacesTable extends Migration
{
    public function up()
    {
        Schema::create('billboard_faces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('billboard_id');

            $table->string('code', 6);
            $table->string('label', 50);
            $table->string('slug', 190);

            $table->decimal('rate_card', 10, 2)->default(0)->comment('the suggest price for this face');
            $table->decimal('monthly_impressions', 10, 2)->default(0);

            $table->enum('type', ['Static', 'Digital'])->default('Static');

            $table->float('width', 10)->nullable()->comment('Face width in ft');
            $table->float('height', 10)->nullable()->comment('Face height in ft');

            $table->text('notes')->nullable();
            $table->text('photo_url')->nullable();

            //if digital
            $table->integer('duration')->nullable()->comment('the amount of time in seconds an add turn will have');
            $table->integer('max_ads')->nullable()->comment('max number of ads this digital billboard can have');

            //if static
            $table->boolean('is_illuminated')->default(false);

            //if illuminated
            $table->string('lights_on', 32)->nullable();
            $table->string('lights_off', 32)->nullable();

            $table->foreign('billboard_id')
                ->references('id')
                ->on('billboards')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('billboard_faces');
    }
}
