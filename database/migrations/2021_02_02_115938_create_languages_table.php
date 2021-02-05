<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id('lang_id');
            $table->string('name');
            $table->boolean('active');
            $table->string('iso_code');
            $table->string('lang_code');
            $table->string('locale');
            $table->date('date_format_lite');
            $table->date('date_format_full');
            $table->boolean('is_rtl');
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
        Schema::dropIfExists('languages');
    }
}
