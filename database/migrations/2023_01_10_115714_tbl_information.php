<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('name',200);
            $table->string('email',200);
            $table->string('phone',200);
            $table->string('address',200);
            $table->string('note',200);
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
        Schema::dropIfExists('tbl_customer');
    }
};
