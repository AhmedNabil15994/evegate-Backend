<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->string("total")->default(0);
            $table->boolean("is_paid")->default(0);

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

            $table->unsignedBigInteger("ads_id")->nullable();
            $table->foreign('ads_id')
                    ->references('id')->on('ads')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');        

            $table->primary(["id"]);
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
        Schema::dropIfExists('ads_orders');
    }
}
