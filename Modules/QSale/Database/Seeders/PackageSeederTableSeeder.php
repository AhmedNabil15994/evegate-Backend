<?php

namespace Modules\QSale\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\QSale\Entities\Package;
use Illuminate\Database\Eloquent\Model;

class PackageSeederTableSeeder extends Seeder
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
        $this->handleBasicPackage();
    }

    public function handleBasicPackage(){
        $data  = [
            [
                "title"=>[
                    "ar"  => "الباقة المجانيه" ,
                    "en"  => "Free Package " ,
                ],
                "description"=>[
                    "ar"  => "الباقة المجانيه" ,
                    "en"  => "Free Package " ,
                ],
                "price"     => 0,
                "duration"  => 15 ,
                "is_free"    => true,   
                "number_of_ads"=> 1 ,
                "number_of_image"=>4,
                "sort"         => 1 
            ]
            
        ];

        foreach ($data as $model) {
            Package::create($model);
        }
    }
}
