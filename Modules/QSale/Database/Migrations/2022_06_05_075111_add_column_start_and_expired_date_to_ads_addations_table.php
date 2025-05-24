<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStartAndExpiredDateToAdsAddationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_addations', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('addation_id');
            $table->date('expire_date')->nullable()->after('start_date');
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_addations', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'expire_date']);
        });
    }
}
