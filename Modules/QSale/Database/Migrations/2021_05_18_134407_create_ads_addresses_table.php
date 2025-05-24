<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_addresses', function (Blueprint $table) {
            $table->uuid('id');

            $table->unsignedBigInteger("ads_id")->nullable();
            $table->foreign('ads_id')
                ->references('id')->on('ads')
                ->onUpdated("cascade")
                ->onDelete('cascade');

            $table->unsignedBigInteger("country_id")->nullable();
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onUpdated("cascade")
                ->onDelete('cascade');


            $table->unsignedBigInteger("city_id")->nullable();
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onUpdated("cascade")
                ->onDelete('cascade');

            $table->unsignedBigInteger("state_id")->nullable();
            $table->foreign('state_id')
                ->references('id')->on('states')
                ->onUpdated("cascade")
                ->onDelete('cascade');

            $table->primary("id");
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
        Schema::dropIfExists('ads_addresses');
    }
}
