<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('country')->onDelete('set null');
            $table->string('name_ar')->default('');
            $table->string('name_en')->default('');
            $table->double("latitude")->nullable()->default(null);
            $table->double("longitude")->nullable()->default(null);
            $table->integer('zip_code')->nullable()->default(null);
            $table->integer('short_cut')->nullable()->default(null);
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
        Schema::dropIfExists('city');
    }
}
