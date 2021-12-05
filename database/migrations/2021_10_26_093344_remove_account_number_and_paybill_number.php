<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAccountNumberAndPaybillNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //dropping account number and pabillnumber from rle_user 
        Schema::table('role_user', function($table) {
            $table->dropColumn('account_number');
            $table->dropColumn('paybill_number');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('role_user', function($table) {
            $table->String('account_number');
            $table->String('paybill_number');
         });
    }
    }

