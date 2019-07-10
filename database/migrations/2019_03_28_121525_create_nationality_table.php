<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationality', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name_ar')->default('');
            $table->string('name_en')->default('');
            $table->Integer('country_id')->nullable()->unsigned();
            $table->foreign('country_id')->references('id')->on('country')->onDelete('set null');
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
        Schema::dropIfExists('nationality');
    }
}
