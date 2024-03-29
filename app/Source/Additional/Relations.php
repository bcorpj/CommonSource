<?php

namespace App\Source\Additional;


class Relations
{
    public static function has ($model, string $field): bool
    {
        try {
            return $model->$field;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
