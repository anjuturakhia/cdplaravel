<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('firstname', 191);
                $table->string('middlename', 191)->nullable();
                $table->string('lastname', 191)->nullable();
                $table->string('email', 191);
                $table->string('password', 191);
                $table->string('remember_token', 191)->nullable();
                $table->integer('active');
                $table->string('mobile',191)->nullable();
                // $table->integer('school_id')->length(11);
                $table->timestamps();
                // $table->softDeletes();
                $table->dateTime('deleted_at')->nullable();
            });
        }
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
