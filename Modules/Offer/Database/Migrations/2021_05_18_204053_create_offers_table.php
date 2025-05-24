<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json("title")->nullable();
            $table->json("description")->nullable();
            $table->double("percent")->default(0);
            $table->string("image")->default("/uploads/default.png");
            $table->date("start_at")->nullable();
            $table->date("end_at")->nullable();
            $table->boolean("status")->default(true);
            $table->unsignedBigInteger("category_id")->nullable();
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate("cascade")
                ->onDelete('cascade');

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
        Schema::dropIfExists('offers');
    }
}
