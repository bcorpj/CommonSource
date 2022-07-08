<?php

namespace Database\Seeders;

use App\Custom\FakeFill\AccessCreator;
use App\Custom\FakeFill\AdminCreator;
use App\Custom\FakeFill\DepartmentCreator;
use App\Custom\FakeFill\PositionCreator;
use App\Custom\FakeFill\ServiceCreator;
use App\Custom\FakeFill\UserCreator;
use App\Custom\FakeFill\UserPropertiesCreator;
use App\Custom\FakeFill\UserServiceCreator;
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
