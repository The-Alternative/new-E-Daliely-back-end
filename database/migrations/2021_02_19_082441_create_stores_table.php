<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string( 'title');
            $table->unsignedInteger('user_id');
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->string( 'default_language');
            $table->unsignedInteger('phone_number');
            $table->string( 'business_email');
            $table->string( 'logo');
            $table->string( 'address');
            $table->string( 'location');
            $table->string( 'working_hours');
            $table->string( 'working_days');
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
        Schema::dropIfExists('stores');
    }
}
