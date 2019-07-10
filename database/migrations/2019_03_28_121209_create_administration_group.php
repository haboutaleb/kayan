<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrationGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administration_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar')->default('');
            $table->string('name_en')->default('');
            $table->longText('permissions'); // JSON DATA 'Permission'
            $table->text('description');
            $table->integer('created_by')->nullable()->default(null);
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
        Schema::dropIfExists('administration_group');
    }
}
