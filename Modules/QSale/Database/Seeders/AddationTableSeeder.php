<?php

namespace Modules\QSale\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\QSale\Entities\Addation;
use Illuminate\Database\Eloquent\Model;

class AddationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->createBasic();
    }

    public function createBasic(){
        $data= [
            [
                "name"=>[
                    "ar"=> "اعلان مميز",
                    "en"=> 'Featured Ad'
                ],
                "description"=>[
                    "ar"=> "اعلان مميز",
                    "en"=> 'Featured Ad'
                ],
                "price"=> 5,
                'type'=>'[]'
            ]
        ];

        foreach ($data as $model) {
            Addation::create($model);
        }
    }
}
