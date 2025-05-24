<?php

use Illuminate\Support\Facades\Schema;
use Modules\Category\Enum\CategoryType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->default("/uploads/default.png");
            $table->string('slug')->nullable();
            $table->unsignedSmallInteger('sort')->default(1);
            $table->boolean('status')->default(true);
            $table->string("type",10)->default(CategoryType::NORMAL)->index();
            // $table->bigInteger('category_id')->unsigned()->nullable();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('categories');
    }
}
