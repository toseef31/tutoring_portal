<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('session_id');
            $table->integer('tutor_id');
            $table->integer('student_id');
            $table->integer('user_id');
            $table->string('subject');
            $table->string('duration');
            $table->string('time');
            $table->string('location');
            $table->enum('session_type', ['First Session', 'Session Before']);
            $table->enum('recurs_weekly', ['Yes', 'No']);
            $table->enum('status', ['Confirm', 'Cancel', 'End', 'Insufficient Credit']);
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
        Schema::dropIfExists('sessions');
    }
}
