<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToTBarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_bar', function (Blueprint $table) {
            $table->string('email_second')->nullable()->after('email');
            $table->string('email_third')->nullable()->after('email_second');
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
            $table->string('email_second')->nullable()->after('email');
            $table->string('email_third')->nullable()->after('email_second');
        });
    }
}