<?php

namespace App\Custom\FakeFill;

use App\Models\UserProperty;
use Faker\Generator;

class UserPropertiesCreator extends Filler\Creator
{

    protected function config()
    {
        parent::set_model(UserProperty::class);
        $this->create_count = 22;
    }

    /**
     * @throws \Exception
     */
    public function create(object $object, Generator $faker)
    {
        $object->position_id = random_int(1, 5);
        $object->department_id = random_int(1, 10);
        $object->user_id = ($this->created)+1;
        $object->profile_image = $faker->url;
        $object->save();
    }
}
