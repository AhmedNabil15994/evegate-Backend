<?php

namespace Modules\QSale\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\QSale\Database\Seeders\AddationTableSeeder;
use Modules\QSale\Database\Seeders\PackageSeederTableSeeder;

class QSaleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(PackageSeederTableSeeder::class);
        $this->call(AddationTableSeeder::class);
    }
}
