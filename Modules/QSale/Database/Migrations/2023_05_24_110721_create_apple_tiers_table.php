<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\QSale\Entities\AppleTier;

class CreateAppleTiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apple_tiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tier_id');
            $table->string('price');
            $table->timestamps();
        });

        foreach(AppleTier::TIERS as $tier){
            AppleTier::create($tier);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apple_tiers');
    }
}
