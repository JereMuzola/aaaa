<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->integer('filiere')->unsigned();
            $table->integer('etudiant')->unsigned();
            $table->foreign('filiere')->references('id')->on('filieres');
            $table->foreign('etudiant')->references('id')->on('etudiants');
            $table->date('date_inscription')->nullable(false);
            $table->primary(['filiere','etudiant']);
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
        Schema::dropIfExists('inscriptions');
    }
}
