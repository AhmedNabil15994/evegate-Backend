<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->uuid('id');
            $table->string("name")->nullable();
            $table->text("message");

            $table->unsignedBigInteger("ads_id");
            $table->foreign('ads_id')
                                ->references('id')->on('ads')
                                ->onUpdated("cascade")
                                ->onDelete('cascade'); 

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
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
        Schema::dropIfExists('complaints');
    }
}
