<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsRepublishedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_republisheds', function (Blueprint $table) {
            $table->uuid('id');

            $table->unsignedInteger("duration");
            $table->string("total")->default(0);
            $table->boolean("is_paid")->default(false);
            $table->boolean("is_free")->default(false);
            $table->unsignedBigInteger("ads_id");
            $table->foreign('ads_id')
                                ->references('id')->on('ads')
                                ->onUpdated("cascade")
                                ->onDelete('cascade');

            $table->unsignedBigInteger("republished_package_id")->nullable();
            $table->foreign('republished_package_id')
                                ->references('id')->on('republished_packages')
                                ->onUpdated("cascade")
                                ->onDelete('set null');

            $table->date("start_at")->nullable();
            $table->date("end_at")->nullable();
            

            
            $table->primary(["id"]);
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
        Schema::dropIfExists('ads_republisheds');
    }
}
