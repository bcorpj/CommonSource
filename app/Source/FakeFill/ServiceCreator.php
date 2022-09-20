<?php

namespace App\Source\FakeFill;

use App\Models\Service;
use Faker\Generator;

class ServiceCreator extends Filler\Creator
{

    protected function config()
    {
        parent::set_model(Service::class);
        $this->is_dynamic = false;
    }

    public function create(object $object, Generator $faker)
    {
        $object::create([
            'name' => 'Support',
            'url' => 'http://support.laravel',
            'data_model' => [
                "User" => [
                    "id",
                    "fullname",
                    "login",
                    "email",
                    "password"
                ],
                "User_property" => [
                    "id",
                    "user_id",
                    "position.name"
                ]
            ],
            'version' => 0.1,
            'key' => 'qwerty1234'
        ]);

        $object::create([
            'name' => 'Contract',
            'url' => 'http://contract.laravel',
            'data_model' => [
                "User" => [
                    "id",
                    "fullname",
                    "login",
                    "email",
                    "password"
                ],
                "User_property" => [
                    "id",
                    "user_id",
                    "position.name"
                ]
            ],
            'version' => 0.4,
            'key' => '1234qwerty'
        ]);
    }
}
