<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token')->nullable();
            $table->string('password')->nullable();
            $table->biginteger('roll_number')->unsigned()->default(0)->length(11);
            $table->string('username')->unique()->length(8);
            $table->biginteger('mobile_number')->length(10)->nullable();
            $table->integer('year')->length(1)->default(0)->nullable();
            $table->boolean('fee_status')->default(false);
            $table->boolean('is_hosteler')->default(false)->nullable();
            $table->boolean('result_status')->default(false);
            $table->string('hostel')->default(false);
            
            $table->string('gender')->default('none')->nullable();
            $table->integer('room_id')->default(0);
            $table->boolean('book_room')->default(false);
            $table->string('type')->default('default');
            $table->longText('access_token')->nullable();
            $table->longText('result_url')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
