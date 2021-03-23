<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('medical_file_number');
            $table->string( 'first_name');
            $table->string( 'father_name');
            $table->string( 'last_name');
            $table->string( 'nationality');
            $table->string( 'place_of_birth');
            $table->date  ( 'date_of_birth');
            $table->string( 'address');
            $table->integer('phone_number');
            $table->string( 'social_status');
            $table->string( 'gender');
            $table->string( 'blood_type');
            $table->string( 'note');
            $table->boolean('is_active');
            $table->boolean('is_approved');
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
        Schema::dropIfExists('patients');
    }
}
