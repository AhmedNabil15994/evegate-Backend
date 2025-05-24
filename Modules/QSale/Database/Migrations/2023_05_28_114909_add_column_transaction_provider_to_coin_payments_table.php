<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTransactionProviderToCoinPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coin_payment_transactions', function (Blueprint $table) {
            $table->string('transaction_provider')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coin_payment_transactions', function (Blueprint $table) {
            $table->dropColumn(['transaction_provider']);
        });
    }
}
