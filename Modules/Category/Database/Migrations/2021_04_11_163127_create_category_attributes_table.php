<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger("attribute_id");
            $table->unsignedBigInteger("category_id");
            
            $table->foreign('attribute_id')->references('id')->on('attributes')
                            ->onUpdate("cascade")
                            ->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
                            ->onUpdate("cascade")
                            ->onDelete('cascade');                

            $table->primary(["attribute_id", "category_id" ]);

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
        Schema::dropIfExists('category_attributes');
    }
}
