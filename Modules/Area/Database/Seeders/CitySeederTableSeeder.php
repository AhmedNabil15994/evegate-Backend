<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Area\Entities\City;
use Illuminate\Database\Eloquent\Model;

class CitySeederTableSeeder extends Seeder
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
        $this->kwCity();
    }

    public function kwCity()
    {
        $cities = [
            [
                "ar"=>[
                    "title"=>"الفروانية",
                    "slug"  => "الفروانية",
                     
                ],
                "en"=>[
                    "title"=>"Alfarwanya",
                    "slug"  => "alfarwanya",
                ]
            ] ,
            [
                "ar"=>[
                    "title"=>"السالمية",
                    "slug"  => "السالمية",
                     
                ],
                "en"=>[
                    "title"=>"al-asimah",
                    "slug"  => "al-asimah",
                ]
            ],
            [
                "ar"=>[
                    "title"=>"االعاصمة",
                    "slug"  => "االعاصمة",
                     
                ],
                "en"=>[
                    "title"=>"Al-Ahmadi",
                    "slug"  => "al-ahmadi",
                ]
            ],
            [
                "ar"=>[
                    "title"=>"الأحمدي",
                    "slug"  => "الأحمدي",
                     
                ],
                "en"=>[
                    "title"=>"al asimah",
                    "slug"  => "al-asimah",
                ]
            ],
            [
                "ar"=>[
                    "title"=>"الجهراء",
                    "slug"  => "الجهراء",
                     
                ],
                "en"=>[
                    "title"=>"Aljahra",
                    "slug"  => "aljahra",
                ]
            ],
            [
                "ar"=>[
                    "title"=>"مبارك الكبير",
                    "slug"  => "مبارك-الكبير",
                     
                ],
                "en"=>[
                    "title"=>"Mubarak akkabyr",
                    "slug"  => "mubarak-akkabyr",
                ]
            ],
            [
                "en"=>[
                    "title"=>"7awaly",
                    "slug"  => "7awaly",
                     
                ],
                "ar"=>[
                    "title"=>"حولي",
                    "slug"  => "حولي",
                ]
            ],
        ];
        foreach ($cities as $key => $city) {
           $data = array_merge($city, ["country_id"=>1]);
           City::create($data);
        }
    }
}
