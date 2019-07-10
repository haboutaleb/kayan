<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('administration_group_id')->nullable()->unsigned()->default(null);
            $table->foreign('administration_group_id')->references('id')->on('administration_group')->onDelete('set null');
            $table->string('email')->unique()->nullable()->default(null);
            $table->string('mobile')->unique();
            $table->string('type')->default('');
            $table->string('identitity_number')->default('');
            $table->string('full_name')->default('');
            $table->string('password');
            $table->string('latitude')->default('');
            $table->string('longitude')->default('');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('lang', ['ar', 'en'])->default('ar');
            $table->enum('active', ['active', 'deactive', 'wait_admin_confirm'])->default('deactive');
            $table->string('code')->nullable()->default('');
            $table->integer('num_try_active')->default(0);
            $table->enum('banned', ['available', 'ban'])->default('available');
            $table->text('ban_reason')->nullable();
            $table->enum('online', ['true', 'false'])->default('true');
            $table->string('image')->default('');
            $table->Integer('city_id')->nullable()->unsigned()->default(null);
            $table->foreign('city_id')->references('id')->on('city')->onDelete('set null');
            $table->Integer('nationality_id')->nullable()->unsigned()->default(null);
            $table->foreign('nationality_id')->references('id')->on('nationality')->onDelete('set null');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->date('date_of_birth')->nullable()->default(null);
            $table->enum('available', ['true', 'false'])->default('true');
            $table->double('wallet')->default(0);
            $table->text('address')->nullable()->default(null);
            $table->text('bref')->nullable()->default(null);
            $table->longText('extras')->nullable()->default(null);
            $table->uuid('uuid');
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
}
