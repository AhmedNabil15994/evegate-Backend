<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAdsAdditionsStartDateAdsAddationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_addations', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'expire_date']);
        });
        Schema::table('ads_addations', function (Blueprint $table) {
            $table->timestamp('start_date');
            $table->timestamp('expire_date');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
