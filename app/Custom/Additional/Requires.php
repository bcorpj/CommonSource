<?php

namespace App\Custom\Additional;

class Requires
{
    public static function assign (bool $type): string
    {
        return $type ? 'required' : 'nullable';
    }
}
