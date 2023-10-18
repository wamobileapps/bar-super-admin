<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTEventSaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_event_save', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('event_id')->nullable();
            $table->longText('event_id')->nullable();
            $table->longText('bar_id')->nullable();
            $table->longText('user_id')->nullable();
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
        //
    }
}
