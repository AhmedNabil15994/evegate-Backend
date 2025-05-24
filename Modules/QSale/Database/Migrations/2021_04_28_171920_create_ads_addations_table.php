<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsAddationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_addations', function (Blueprint $table) {
            $table->unsignedBigInteger("ads_id");
            $table->string("price")->nullable();
            $table->foreign('ads_id')
                    ->references('id')->on('ads')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            $table->unsignedBigInteger("addation_id");
            $table->foreign('addation_id')
                    ->references('id')->on('addations')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            $table->primary(["addation_id", "ads_id"])  ;    
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
        Schema::dropIfExists('ads_addations');
    }
}
