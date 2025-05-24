<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_attributes', function (Blueprint $table) {
            $table->uuid('id');

            $table->string("value")->nullable();
            $table->unsignedBigInteger("ads_id")->nullable();
            $table->foreign('ads_id')
                    ->references('id')->on('ads')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

            $table->unsignedBigInteger("attribute_id")->nullable();
            $table->foreign('attribute_id')
                    ->references('id')->on('attributes')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

            $table->unsignedBigInteger("option_id")->nullable();
            $table->foreign('option_id')
                    ->references('id')->on('options')
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
        Schema::dropIfExists('ads_attributes');
    }
}
