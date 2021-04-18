<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->datetime('startingdate');
            $table->datetime('endingdate');
            $table->integer('participants');
            $table->string('room');

          //  $table->bigInteger('user_id')->unsigned()->index();
         //   $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           //$table->bigInteger('room_id')->unsigned()->index();
            //$table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');


        //    $table->Integer('user_id')->nullable(true)->unsigned();
       //    $table->Integer('room_id')->nullable(true)->unsigned();



         //   $table->foreign('user_id')->references('id')->on('users')
         //       ->onUpdate('cascade')->onDelete('cascade');


          //  $table->foreign('room_id')->references('id')->on('rooms')
          //      ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('programmes');
    }
}
