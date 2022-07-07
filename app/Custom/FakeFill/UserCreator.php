<?php

namespace App\Custom\FakeFill;

use App\Custom\FakeFill\Filler\Creator;
use App\Models\User;
use Faker\Generator;

class UserCreator extends Creator
{
    public function create(object $object, Generator $faker)
    {
        $object->fullname = $faker->name;
        $object->login = $faker->userName;
        $object->email = $faker->email;
        $object->phone_number = $faker->numerify('8778#######');
        $object->password = 'daaad6e5604e8e17bd9f108d91e26afe6281dac8fda0091040a7a6d7bd9b43b5';
        $object->LDAP = true;

        $object->save();
    }

    protected function config()
    {
        parent::set_model(User::class);
        parent::set_lang('ru_RU');
    }
}
