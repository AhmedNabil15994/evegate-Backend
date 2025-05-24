<?php

use Modules\User\Enums\UserType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->string("mobile")->nullable();
            $table->boolean("hide_private_number")->default(false);
            $table->string("image")->default("/uploads/default.png");
            $table->date("start_at")->nullable();
            $table->date("end_at")->nullable();
            $table->string("duration")->default(0);

            $table->string("status", 20)->default("wait")->index();
            $table->boolean("is_paid")->index()->default(false);
            $table->string("type", 20)->index()->default("normal");
            $table->double("price")->nullable();
            $table->string("user_type", 25)->default(UserType::USER)->index();
            
            $table->string("addation_total")->default(0);
            $table->string("ads_price")->default("0");
            $table->string("total")->default("0");
            $table->unsignedBigInteger("view")->default(0);

            $table->uuid("subscription_id")->nullable();
            $table->foreign('subscription_id')
                ->references('id')->on('subscriptions')
                ->onUpdated("cascade")
                ->onDelete('set null')
            ;

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
             
            $table->unsignedBigInteger("category_id")->nullable();
            $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            // $table->unsignedBigInteger("country_id")->nullable();
            // $table->foreign('country_id')
            //                     ->references('id')->on('countries')
            //                     ->onUpdated("cascade")
            //                     ->onDelete('set null');
    
    
            // $table->unsignedBigInteger("city_id")->nullable();
            // $table->foreign('city_id')
            //                     ->references('id')->on('cities')
            //                     ->onUpdated("cascade")
            //                     ->onDelete('set null');
                                
            // $table->unsignedBigInteger("state_id")->nullable();
            // $table->foreign('state_id')
            //                     ->references('id')->on('states')
            //                     ->onUpdated("cascade")
            //                     ->onDelete('set null');

            $table->softDeletes();
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
        Schema::dropIfExists('ads');
    }
}
