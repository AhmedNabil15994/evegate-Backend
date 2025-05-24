<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->string('link')->nullalbe()->default('#');
            $table->boolean('status')->default(false);
            $table->json("info")->nullable();
            $table->string("type", 15)->index()->default("out");
            $table->date('start_at');
            $table->date('end_at');
            $table->unsignedBigInteger("ads_id")->nullable();
            $table->foreign('ads_id')
                    ->references('id')->on('ads')
                    ->onUpdated("cascade")
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
        Schema::dropIfExists('adverstings');
    }
}
