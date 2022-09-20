<?php

namespace App\Source\FakeFill;

use App\Models\Department;
use Faker\Generator;

class DepartmentCreator extends Filler\Creator
{

    protected function config()
    {
        $this->set_model(Department::class);
    }

    public function create(object $object, Generator $faker)
    {
        $object->name = $faker->bs;
        $object->abbreviation = $faker->stateAbbr;
        $object->save();
    }
}
