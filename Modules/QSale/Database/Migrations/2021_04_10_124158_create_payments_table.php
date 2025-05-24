<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id');
            $table->string("total")->default(0);
            $table->json("owner")->nullable();
            $table->json("transaction")->nullable();
            $table->json("data")->nullable();
            $table->uuidMorphs("order");
            $table->string("status",15)->default("wait");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdated("cascade")
                ->onDelete('set null');

            $table->primary("id");
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
        Schema::dropIfExists('payments');
    }
}
