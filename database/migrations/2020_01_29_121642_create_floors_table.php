<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hostel_id')->unsigned();
            $table->biginteger('floor_number');
            $table->biginteger('from');
            $table->biginteger('to');
            $table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');

            $table->timestamps();
        });

        // Schema::table('floors', function (Blueprint $table) {

        //     $table->foreign('floors_hostel_id')->references('id')->on('hostels')->onDelete('cascade');
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floors');
    }
}
