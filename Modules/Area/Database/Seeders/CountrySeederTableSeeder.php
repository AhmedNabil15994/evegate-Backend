<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Area\Entities\Country;
use Illuminate\Database\Eloquent\Model;

class CountrySeederTableSeeder extends Seeder
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
        $this->createKw();
    }

    public function createKw(){
        Country::create([
            "ar"=>[
                "title"=>"الكويت",
                "slug"  => "الكويت",
                 
            ],
            "en"=>[
                "title"=>"kwait",
                "slug"  => "kwait",
            ]
        ]);
    }
}
