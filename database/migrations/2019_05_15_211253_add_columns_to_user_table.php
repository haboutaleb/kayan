<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            //
            $table->string('specialize_image')->nullable()->default('');
            $table->string('linked_in')->nullable()->default('');
            $table->string('total_review')->nullable()->default('');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('extras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
            $table->dropColumn('specialize_image');
            $table->dropColumn('linked_in');
            $table->dropColumn('total_review');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->date('date_of_birth')->nullable()->default(null);
            $table->longText('extras')->nullable()->default(null);
        });
    }
}
