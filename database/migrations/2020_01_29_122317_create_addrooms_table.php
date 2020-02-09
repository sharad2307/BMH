<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('year');
            $table->integer('hostel_id')->unsigned();
            $table->biginteger('room_number');
            $table->biginteger('floor_number');
            $table->timestamps();
        });

        Schema::table('addrooms', function (Blueprint $table) {

            $table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addrooms');
    }
}
