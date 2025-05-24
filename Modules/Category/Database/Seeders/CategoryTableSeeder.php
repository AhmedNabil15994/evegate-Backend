<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryTableSeeder extends Seeder
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
        $this->createBaseCategory();
    }
    public function createBaseCategory(){
        $data = [
            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b", 
                "status" => true,
                "en"=>[
                    "title"=>"Satellite",
                    "slug"     => "satellite" ,
                ],
                "ar"=>[
                    "title"=>"الدش والريسيفر",
                    "slug"     => "الدش -الريسيفر" ,
                ],
                "children"=>[
                    [
                        "en"=>[
                            "title"=>"Receiving programming",
                            "slug"     => "receiving-programming" ,
                        ],
                        "ar"=>[
                            "title"=>" برمجة رسيفر",
                            "slug"     => "برمجة-رسيفر" ,
                        ]
                    ],
                    [
                        "en"=>[
                            "title"=>"Maintenance and installation Satellite",
                            "slug"     => "maintenance-installation-Satellite" ,
                        ],
                        "ar"=>[
                            "title"=>"صيانة و تركيب مستقبل",
                            "slug"     => "صيانة-تركيب-مستقبل" ,
                        ]
                    ],
                    [
                        "en"=>[
                            "title"=>"Satellite receiver encoder",
                            "slug"     => "satellite-receiver-encoder" ,
                        ],
                        "ar"=>[
                            "title"=>"تشفير رسيفر",
                            "slug"     => "تشفير-الريسيفر" ,
                        ]
                    ]

                ]
            ] ,
            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b", 
                "status" => true,
                "en"=>[
                    "title"=>"Glass and mirrors",
                   
                    "slug"     => "glass-mirrors" ,
                ],
                "ar"=>[
                    "title"=>" الزجاج والمرايات ",
                    "slug"     => " الزجاج-المرايات" ,
                ],
                "children" => [
                    [   
                        "en"=>[
                            "title"=>"Replace glass and mirrors",
                           
                            "slug"     => "replace-glass-mirrors" ,
                        ],
                        "ar"=>[
                            "title"=>"تبديل الزجاج والمرايات ",
                            "slug"     => "تبديل-الزجاج-المرايات" ,
                        ],
                        "en"=>[
                            "title"=>"}omposing glass and mirrors",
                           
                            "slug"     => "composing-glass-mirrors" ,
                        ],
                        "ar"=>[
                            "title"=>"تركيب الزجاج والمرايات ",
                            "slug"     => "تركيب-الزجاج-المرايات" ,
                        ],
                    ]
                ]
                
            ] 
                ];

        foreach ($data as $category) {
            # code...
            $children = $category["children"];
            unset($category["children"]);
            $model = Category::create($category);
            $model->children()->createMany($children);
        }
    }
}
