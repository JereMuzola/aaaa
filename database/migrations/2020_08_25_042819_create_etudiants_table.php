<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricule',20)->unique()->nullable(false);
            $table->string('nom', 100)->nullable(false);
            $table->string('postnom', 100)->nullable(false);
            $table->string('prenom', 100)->nullable(false);
            $table->enum('sexe',['Masculin','Feminin'])->nullable(false);
            $table->string('lieu_de_naissance', 100)->nullable(false);
            $table->date('date_de_naissance')->nullable(false);
            $table->string('promotion',10)->nullable(false);
            $table->text('adresse')->nullable(false);
            $table->integer('institution')->unsigned();
            $table->foreign('institution')->references('id')->on('institutions');
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
        Schema::dropIfExists('etudiants');
    }
}
