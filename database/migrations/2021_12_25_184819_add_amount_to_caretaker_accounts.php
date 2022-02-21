<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountToCaretakerAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caretaker_accounts', function (Blueprint $table) {
            //
            $table->integer("service_charge_amount")->after("paybill_number");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caretaker_accounts', function (Blueprint $table) {
            //
        });
    }
}
