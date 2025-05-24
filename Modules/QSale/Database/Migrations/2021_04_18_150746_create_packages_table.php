<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json("title");
            $table->json("description")->nullable();
            $table->boolean("status")->default(true);
            $table->string("price")->default(0);
            $table->unsignedInteger("duration")->default(1);
            $table->unsignedInteger("number_of_ads")->default(1);
            $table->unsignedInteger("number_of_image")->default(1);
            $table->unsignedTinyInteger("sort")->default(2);
            $table->unsignedInteger("duration_of_ads")->default(4);
            $table->boolean("is_free");
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
        Schema::dropIfExists('packages');
    }
}
