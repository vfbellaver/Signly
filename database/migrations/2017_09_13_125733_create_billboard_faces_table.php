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

            $table->string('code', 32);
            $table->string('slug', 48);
            $table->string('label', 32);
            $table->enum('facing', ['North', 'South', 'East', 'West', 'Other'])->nullable();
            $table->enum('reads', ['Left', 'Right', 'Across'])->nullable();

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
            $table->boolean('is_illuminated')->nullable();

            //if illuminated
            $table->string('lights_on', 32)->nullable();
            $table->string('lights_off', 32)->nullable();

            $table->unique(['team_id', 'code']);

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
