<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_histories', function (Blueprint $table) {
            $table->uuid('id');

            $table->json("data")->nullalbe();

            $table->uuid("subscription_id");
            $table->uuid("payment_id")->nullable();
            $table->unsignedBigInteger("package_id")->nullable();
            $table->foreign('package_id')
                ->references('id')->on('packages')
                ->onUpdated("cascade")
                ->onDelete('cascade');

            $table->foreign('subscription_id')
                ->references('id')->on('subscriptions')
                ->onUpdated("cascade")
                ->onDelete('cascade')   
                ;

            $table->foreign('payment_id')
                ->references('id')->on('payments')
                ->onUpdated("cascade")
                ->onDelete('cascade')   ;


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
        Schema::dropIfExists('subscription_histories');
    }
}
