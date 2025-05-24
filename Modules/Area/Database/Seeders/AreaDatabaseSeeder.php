<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Area\Database\Seeders\CitySeederTableSeeder;
use Modules\Area\Database\Seeders\StateSeederTableSeeder;
use Modules\Area\Database\Seeders\CountrySeederTableSeeder;

class AreaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountrySeederTableSeeder::class);
        $this->call(CitySeederTableSeeder::class);
        $this->call(StateSeederTableSeeder::class);
    }
}
