<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalBillboardFacesTable extends Migration
{
    public function up()
    {
        Schema::create('proposal_billboard_face', function (Blueprint $table) {
            $table->unsignedInteger('proposal_id');
            $table->unsignedInteger('billboard_face_id');

            $table->decimal('price', 10, 2);
            $table->integer('order');

            $table->timestamps();

            $table->primary(['proposal_id', 'billboard_face_id']);

            $table->foreign('proposal_id')
                ->references('id')
                ->on('proposals')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('billboard_face_id')
                ->references('id')
                ->on('billboard_faces')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposal_billboard_faces');
    }
}
