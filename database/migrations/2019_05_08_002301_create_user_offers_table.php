<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_offers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('price')->nullable()->default('');
            $table->string('details')->nullable()->default('');
            $table->enum('status',['pending','confirmed','cancelled'])->default('pending');

            $table->integer('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');

            $table->bigInteger('from_user')->unsigned();
            $table->foreign('from_user')->references('id')->on('user')->onDelete('cascade');
            $table->bigInteger('to_user')->unsigned();
            $table->foreign('to_user')->references('id')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists('user_offers');
    }
}
