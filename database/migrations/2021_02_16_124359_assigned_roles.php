<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignedRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasTable('assigned_roles'))
        {
            Schema::create('assigned_roles', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->length(11);
                $table->integer('role_id')->length(11);
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
        //
    }
}
