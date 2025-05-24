<?php

namespace Modules\Section\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Section\Entities\Section;
use Illuminate\Database\Eloquent\Model;

class SectionSeederTableSeeder extends Seeder
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
        $this->createSectionBase();
    }

    public function createSectionBase()
    {
        $data = [
            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Kindergarten",
                    "description"  => "kindergarten",
                    "slug"     => "kindergarten" ,
                ],
                "ar"=>[
                    "title"=>" رياض اطفال ",
                    "description"  => " رياض اطفال ",
                    "slug"     => "رياض-اطفال" ,
                ]
            ] ,
            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Primary stage",
                    "description"  => "primary stage",
                    "slug"     => "Primary-stage" ,
                ],
                "ar"=>[
                    "title"=>"المرحلة الابتدائيه",
                    "description"  => "المرحلة الابتدائيه",
                    "slug"     => "المرحلة-الابتدائيه" ,
                ]
            ] ,
            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Intermediate stage",
                    "description"  => "intermediate stage",
                    "slug"     => "intermediate-stage" ,
                ],
                "ar"=>[
                    "title"=>"المرحله المتوسطه ",
                    "description"  => " المرحله المتوسطه",
                    "slug"     => "المرحله-المتوسطه" ,
                ]
                ],
                [
                    "image" =>"/uploads/default.png",
                    "color" => "#e08b8b",
                    "status" => true,
                    "en"=>[
                        "title"=>"High stage",
                        "description"  => "high stage",
                        "slug"     => "high-stage" ,
                    ],
                    "ar"=>[
                        "title"=>"المرحله الثانويه ",
                        "description"  => " المرحله الثانويه",
                        "slug"     => "المرحله-الثانويه" ,
                    ]
                ]
                ];

        foreach ($data as $section) {
            # code...
            Section::create($section);
        }
    }
}
