<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryIdToShippingCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_companies', function (Blueprint $table) {
            $table->unsignedBigInteger("country_id")->default(config("customs.country_id"));
            $table->foreign('country_id')
                                ->references('id')->on('countries')
                                ->onUpdated("cascade")
                                ->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_companies', function (Blueprint $table) {
            $table->dropColumn(['countries']);
        });
    }
}
