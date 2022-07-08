<?php

namespace App\Custom\FakeFill;

use App\Models\Access;
use Faker\Generator;

class AccessCreator extends Filler\Creator
{

    protected function config()
    {
        parent::set_model(Access::class);
    }

    public function create(object $object, Generator $faker)
    {
        $object->name = $faker->city();
        $object->keys = [1,3,4,12];
        $object->department_access = [3];
        $object->user_id = ($this->created)+1;
        $object->save();
    }
}
