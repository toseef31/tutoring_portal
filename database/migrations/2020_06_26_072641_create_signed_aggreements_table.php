<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignedAggreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signed_aggreements', function (Blueprint $table) {
          $table->increments('signed_id');
          $table->integer('aggreement_id');
          $table->integer('user_id');
          $table->string('aggreement_name');
          $table->string('aggreement_file');
          $table->enum('status', ['Awaiting Signature', 'Signed']);
          $table->string('user_name')->nullable();
          $table->string('date')->nullable();
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
        Schema::dropIfExists('signed_aggreements');
    }
}
