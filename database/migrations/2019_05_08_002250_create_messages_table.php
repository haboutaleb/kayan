<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('message');
            $table->enum('status',['pending','seen'])->default('pending');
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
        Schema::dropIfExists('messages');
    }
}
