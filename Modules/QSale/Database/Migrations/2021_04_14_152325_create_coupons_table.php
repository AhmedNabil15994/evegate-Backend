<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id');
            $table->string("code",100)->unique();
            $table->string("min")->default(0);
            $table->string("max")->default(0);
            $table->string("amount");
            $table->boolean("is_fixed")->default(1);
            $table->string("current_use")->default(0);
            $table->string("max_use")->default(50);;
            $table->string("max_use_user")->default(1);;
            $table->date("expired_at");
            $table->boolean("status")->default(1);
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
        Schema::dropIfExists('coupons');
    }
}
