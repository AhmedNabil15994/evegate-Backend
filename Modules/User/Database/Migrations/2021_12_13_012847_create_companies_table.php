<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->text("description_work")->nullable();
            $table->unsignedBigInteger("state_id")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->foreign('state_id')
                ->references('id')->on('states')
                ->onUpdated("cascade")
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdated("cascade")
                ->onDelete('cascade');

            $table->string("document")->nullable();


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
        Schema::dropIfExists('companies');
    }
}
