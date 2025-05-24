<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id');
            $table->boolean("is_paied")->index()->default(true);
            $table->boolean("is_free")->index()->default(false);
            $table->boolean("is_default")->index()->default(false);
            $table->string("duration_of_ads")->default(4);
            $table->date("start_at")->nullable();
            $table->date("end_at")->nullable();
            $table->unsignedInteger("current_use")->default(0);
            $table->unsignedInteger("max_use")->default(0);
            $table->timestamp("renewal_at")->nullable();    
            $table->string("money")->default(0);
            $table->primary(["id"]);
            $table->unsignedBigInteger("package_id")->nullable();
            $table->unsignedInteger("renewal_count")->default(0);
            $table->foreign('package_id')
                    ->references('id')->on('packages')
                    ->onUpdated("cascade")
                    ->onDelete('set null');

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

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
        Schema::dropIfExists('subscriptions');
    }
}
