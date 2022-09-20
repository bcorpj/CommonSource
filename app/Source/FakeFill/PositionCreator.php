<?php

namespace App\Source\FakeFill;

use App\Source\FakeFill\Filler\Creator;
use App\Models\Position;
use Faker\Generator;

class PositionCreator extends Creator
{

    protected function config()
    {
        parent::set_model(Position::class);
        $this->create_count = 5;
    }

    public function create(object $object, Generator $faker)
    {
        $object->name = $faker->jobTitle;
        $object->save();
    }
}
