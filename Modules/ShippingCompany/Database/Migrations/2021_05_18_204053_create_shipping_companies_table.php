<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json("title")->nullable();
            $table->json("address")->nullable();
            $table->string("image")->default("/uploads/default.png");
            $table->boolean("status")->default(true);
            $table->string("phone_number")->nullable();
            $table->string("phone_whatsapp")->nullable();
            $table->string("lat")->nullable();
            $table->string("long")->nullable();
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
        Schema::dropIfExists('shipping_companies');
    }
}
