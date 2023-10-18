<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAddGameToTBarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_bar', function (Blueprint $table) {
            $table->boolean('is_add_game')->default(0)->comment('0 = no, 1 = yes')->after('is_password_link_valid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_bar', function (Blueprint $table) {
            $table->boolean('is_add_game')->default(0)->comment('0 = no, 1 = yes')->after('is_password_link_valid');
        });
    }
}
