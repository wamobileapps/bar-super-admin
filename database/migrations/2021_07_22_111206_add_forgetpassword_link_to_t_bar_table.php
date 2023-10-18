<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForgetpasswordLinkToTBarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_bar', function (Blueprint $table) {
             $table->text('description')->nullable()->after('cover_image');
            $table->string('bar_type')->nullable()->after('description');
            $table->time('bar_hours')->nullable()->after('bar_type');
            $table->string('forgetpassword_link')->nullable()->after('open_time');
            $table->dateTime('is_password_link_valid')->nullable()->after('forgetpassword_link');
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
             $table->text('description')->nullable()->after('cover_image');
            $table->string('bar_type')->nullable()->after('description');
            $table->time('bar_hours')->nullable()->after('bar_type');
            $table->string('forgetpassword_link')->nullable()->after('open_time');
            $table->dateTime('is_password_link_valid')->nullable()->after('forgetpassword_link');
        });
    }
}
