<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('subscription_id')->nullable();
            $table->string('code');
            $table->string('discount_type');
            $table->double('discount_percentage')->nullable();
            $table->double('discount_value')->nullable();
            $table->foreign('subscription_id')
                ->references('id')
                ->on('subscriptions')
                ->onDelete('cascade');
            $table->uuid('coupon_id')->nullable();
            $table->foreign('coupon_id')
                ->references('id')
                ->on('coupons')
                ->onDelete('set null');
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
        Schema::dropIfExists('coupon_subscriptions');
    }
}
