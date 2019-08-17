<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attentions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id', 'fk_patient_attention')->references('id')->on('patients')->onDelete('restrict')->onUpdate('restrict');
            $table->string('diagnostic');
            $table->string('reason');
            $table->integer('derivation')->nullable();
            $table->string('observation')->nullable();
            $table->string('articulation')->nullable();
            $table->unsignedTinyInteger('internment');
            $table->string('pharmacotherapy')->nullable();
            $table->date('date');
            $table->string('accompaniment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attentions');
    }
}
