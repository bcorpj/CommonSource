<?php

namespace App\Source\FakeFill;

use App\Models\UserService;
use Faker\Generator;

class UserServiceCreator extends Filler\Creator
{
    private int $for_external_id = 10;

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
        $object->external_user_id = $this->for_external_id--;
        $object->save();
    }
}
