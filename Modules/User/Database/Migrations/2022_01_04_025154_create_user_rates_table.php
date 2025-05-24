<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rates', function (Blueprint $table) {
            $table->uuid("id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("from_id");
            $table->unsignedSmallInteger("rate")->default(0);
            $table->text("note")->nullable();
            $table->foreign('user_id')
                                ->references('id')->on('users')
                                ->onUpdated("cascade")
                                ->onDelete('cascade');
            $table->foreign('from_id')
            ->references('id')->on('users')
            ->onUpdated("cascade")
            ->onDelete('cascade');

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
        Schema::dropIfExists('user_rates');
    }
}
