<?php

namespace Modules\Page\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Page\Entities\Page;
use Illuminate\Database\Eloquent\Model;

class PageSeederTableSeeder extends Seeder
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
        $this->createBasePage();
    }

    public function createBasePage(){
        $data = [
            [
                "en"=>[
                    "title"=>"About us",
                    "description"  => "About us",
                    "slug"     => "about-us" ,
                ],
                "ar"=>[
                    "title"=>"عن التطبيق",
                    "description"  => "عن التطبيق",
                    "slug"     => "عن-التطبيق" ,
                ]
            ] ,
            [
                "en"=>[
                    "title"=>"term",
                    "description"  => "term",
                    "slug"     => "term" ,
                ],
                "ar"=>[
                    "title"=>"الشروط واالاحكام",
                    "description"  => "الشروط والاحكام",
                    "slug"     => "الشروط-و-الاحكام" ,
                ]
            ]
                ];
       foreach ($data as $page) {
           # code...
           Page::create($page);
       }
    }
}
