<?php

namespace App\Custom\FakeFill;

use App\Models\UserService;
use Faker\Generator;

class UserServiceCreator extends Filler\Creator
{

    protected function config()
    {
        parent::set_model(UserService::class);
    }

    /**
     * @throws \Exception
     */
    public function create(object $object, Generator $faker)
    {
        $object->user_id = ($this->created)+1;
        $object->blocked = false;
        $object->service_id = random_int(1, 2);
        $object->save();
    }
}
