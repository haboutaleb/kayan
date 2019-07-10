<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->text('fcm')->nullable()->default(null);
            $table->enum('device_type', ['android', 'ios', 'win_phone', 'windows', 'linux', 'mac', 'undefined'])->default('android');
            $table->text('jwt')->nullable()->default(null);
            $table->enum('is_logged_in', ['true', 'false'])->default('true');
            $table->ipAddress('ip')->nullable()->default(null);
            $table->macAddress('mac')->nullable()->default(null);
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
        Schema::dropIfExists('token');
    }
}
