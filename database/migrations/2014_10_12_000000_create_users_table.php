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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token');
            $table->string('password');
            $table->biginteger('roll_number')->unique()->unsigned()->default(0)->length(11);
            $table->string('admission_number')->unique()->length(8);
            $table->biginteger('mobile_number')->length(10);
            $table->integer('year')->length(1)->default(0);
            $table->boolean('fee_status')->default(false);
            $table->boolean('is_hosteler')->default(false);
            $table->boolean('result_status')->default(false);
            $table->boolean('is_rejected')->default(false);
            $table->string('utr_number')->default(0);
            $table->string('branch')->default('none');
            $table->boolean('fine')->default(false);
            $table->string('gender')->default('none');
            $table->integer('room_id')->default(0);
            $table->boolean('book_room')->default(false);
            $table->string('type')->default('default');
            $table->string('account_holder_name')->default('0');
            $table->string('ifsc_code')->default('0');
            $table->string('bank_address')->default('none');
            $table->string('deposit_date')->default('none');
            $table->biginteger('amount')->default('0');
            $table->string('access_token');


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
