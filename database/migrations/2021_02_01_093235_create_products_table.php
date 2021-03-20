<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('trans_lang');
<<<<<<< HEAD
            $table->integer('trans_of')->unsigned();
=======
            $table->unsigned('trans_of');
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
            $table->string('title');
            $table->string('slug');
            $table->integer('brand_id');
            $table->string('barcode');
            $table->string('image');
            $table->string('short_des');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_appear')->default(true);
            $table->string('meta');
            $table->string('description');
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
        Schema::dropIfExists('products');
    }
}
