<?php

namespace Database\Seeders;

use App\Source\FakeFill\AccessCreator;
use App\Source\FakeFill\AdminCreator;
use App\Source\FakeFill\DepartmentCreator;
use App\Source\FakeFill\PositionCreator;
use App\Source\FakeFill\ServiceCreator;
use App\Source\FakeFill\UserCreator;
use App\Source\FakeFill\UserPropertiesCreator;
use App\Source\FakeFill\UserServiceCreator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DataFillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call("migrate:fresh");
        new DepartmentCreator();
        new PositionCreator();
        new UserCreator();
        new UserPropertiesCreator();
        new ServiceCreator();
        new UserServiceCreator();
        new AdminCreator();
        new AccessCreator();
    }
}
