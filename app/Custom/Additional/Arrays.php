<?php

namespace App\Custom\Additional;

class Arrays
{

    /**
     * For `updateOrCreate` method
     * @param string $key
     * @param array $data
     * @return array|int[]|null
     * Check given array by key if there is exists the item return new array,
     * Otherwise return new array by value -1
     */
    public static function is_item (string $key, array $data): ?array
    {
        if ( !isset($data[$key]) )
            return [$key => -1];

        return [$key => $data[$key]];
    }
}
