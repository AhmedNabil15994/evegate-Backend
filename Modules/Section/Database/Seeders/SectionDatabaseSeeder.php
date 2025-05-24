<?php

namespace Modules\Section\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Section\Database\Seeders\SectionSeederTableSeeder;

class SectionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SectionSeederTableSeeder::class);
    }
}
