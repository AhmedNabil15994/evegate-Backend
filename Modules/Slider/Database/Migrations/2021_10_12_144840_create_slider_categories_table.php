<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_categories', function (Blueprint $table) {
            // $table->bigIncrements('id');

            $table->unsignedBigInteger("slider_id");
            $table->foreign('slider_id')
                    ->references('id')->on('sliders')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            $table->primary(["category_id", "slider_id"]);
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
        Schema::dropIfExists('slider_categories');
    }
}
