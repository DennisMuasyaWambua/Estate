<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupants', function (Blueprint $table) {
            $table->id();
            $table->integer('caretakerId');
            $table->String('name');
            $table->String('email')->unique();
            $table->String('phone');
            $table->String('password')->default('password');
            $table->String('estate');
            $table->String('blockNumber');
            $table->String('flatNumber');
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
        Schema::dropIfExists('occupants');
    }
}
