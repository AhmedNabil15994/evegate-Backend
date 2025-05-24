<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\QSale\Entities\AppleTier;
use Modules\QSale\Entities\Coin;

class AddColumnSeedTiersToCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $counter = 1;
        foreach(AppleTier::all() as $tier){
            Coin::create([
                "title" => [
                    'ar' => $counter * 5,
                    'en' => $counter * 5
                ],
                "status" => 1,
                "coins_number" => $counter * 5,
                "apple_tier_id" => $tier->id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
