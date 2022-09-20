<?php

namespace App\Source\FakeFill;

use App\Source\FakeFill\Filler\Creator;
use App\Models\Admin;
use Faker\Generator;

class AdminCreator extends Creator
{

    protected function config()
    {
        parent::set_model(Admin::class);
        $this->create_count = 2;
    }

    public function create(object $object, Generator $faker)
    {
        $object->user_id = random_int(1, 10);
        $object->department_access = '[]';
        $object->access = '[]';
        $object->save();
    }
}
