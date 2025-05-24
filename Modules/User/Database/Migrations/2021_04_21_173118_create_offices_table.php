<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->string("mobile")->nullable();
            $table->boolean("status")->default(true);
            $table->string("image")->default("/uploads/default.png");

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
         
           $table->unsignedBigInteger("country_id")->nullable();
           $table->foreign('country_id')
                            ->references('id')->on('countries')
                            ->onUpdated("cascade")
                            ->onDelete('set null');    


            $table->unsignedBigInteger("city_id")->nullable();
            $table->foreign('city_id')
                                ->references('id')->on('cities')
                                ->onUpdated("cascade")
                                ->onDelete('set null');  
                                
            $table->unsignedBigInteger("state_id")->nullable();
            $table->foreign('state_id')
                                ->references('id')->on('states')
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
        Schema::dropIfExists('offices');
    }
}
