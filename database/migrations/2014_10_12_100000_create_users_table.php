<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id')->nullable();

            $table->string('name', 64)->nullable();
            $table->string('photo_url', 128)->nullable();
            $table->string('email', 128)->unique();
            $table->string('password')->nullable();
            $table->string('invitation_token')->nullable();
            $table->boolean('status')->default(1);

            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->date('card_expiration')->nullable();
            $table->date('trial_ends_at')->nullable();

            $table->string('address', 256)->nullable();
            $table->decimal('lat', 18, 15)->nullable();
            $table->decimal('lng', 18, 15)->nullable();
            $table->string('timezone')->nullable();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
