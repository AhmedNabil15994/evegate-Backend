<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddationOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addation_orders', function (Blueprint $table) {
            $table->uuid('id');

            $table->string("price")->nullable();
            $table->uuid("ads_order_id");
            $table->foreign('ads_order_id')
                    ->references('id')->on('ads_orders')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

            $table->unsignedBigInteger("addation_id");
            $table->foreign('addation_id')
                    ->references('id')->on('addations')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            $table->primary(["id"]);

            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
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
        Schema::dropIfExists('addation_orders');
    }
}
