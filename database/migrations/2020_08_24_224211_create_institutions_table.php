<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_institution', 150)->nullable(false);
            $table->text('adresse')->nullable(false);
            $table->enum('type',['Ecole','Université','Institut supérieure'])->nullable(false);
            $table->string('province', 80)->nullable(false);
            $table->string('pseudo',50)->unique();
            $table->string('password','200');
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
        Schema::dropIfExists('institutions');
    }
}
