<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsAdTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_ad_types', function (Blueprint $table) {
            $table->unsignedBigInteger("ads_id");
            $table->foreign('ads_id')
                    ->references('id')->on('ads')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            $table->unsignedBigInteger("ad_type_id");
            $table->foreign('ad_type_id')
                    ->references('id')->on('ad_types')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            $table->primary(["ad_type_id", "ads_id"])  ;
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
        Schema::dropIfExists('ads_ad_types');
    }
}
