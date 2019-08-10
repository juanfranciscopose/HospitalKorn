<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('clinical_history_number')->unique();
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->unsignedTinyInteger('party');
            $table->unsignedTinyInteger('town');
            $table->string('address');
            $table->string('gender');
            $table->unsignedTinyInteger('document_type');
            $table->integer('document_number');
            $table->integer('folder_number')->nullable();
            $table->string('telephone')->nullable();
            $table->unsignedTinyInteger('social_work')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
