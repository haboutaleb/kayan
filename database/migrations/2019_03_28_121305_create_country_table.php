<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar')->default('');
            $table->string('name_en')->default('');
            $table->string('show_key')->default('');
            $table->integer('tel_key')->nullable()->default(null);
            $table->enum('continent', ['Africa', 'Europe', 'USA', 'Asia', 'Amirca'])->default('Africa');
            $table->string('image')->default('');
            $table->softDeletes();
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
        Schema::dropIfExists('country');
    }
}
