<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        if(!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 191);
                $table->string('description', 191)->nullable();
                $table->string('image', 191);
                $table->string('price', 191)->nullable();
                $table->string('discount_percent', 191)->nullable();
                $table->string('status', 191)->nullable();
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
