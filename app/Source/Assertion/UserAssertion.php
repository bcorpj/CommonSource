<?php

namespace App\Source\Assertion;

use App\Models\User;
use App\Source\Assertion\Code\Assertable;
use Hash;

class UserAssertion extends Assertable
{
    protected function init(): array
    {
        return [
            $this->model->login,
            $this->model->phone_number
        ];
    }
}
