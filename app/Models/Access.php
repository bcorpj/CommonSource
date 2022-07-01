<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Access
 *
 * @property int $id
 * @property string $name
 * @property mixed $keys
 * @method static \Illuminate\Database\Eloquent\Builder|Access newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Access newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Access query()
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereKeys($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Access whereName($value)
 * @mixin \Eloquent
 */
class Access extends Model
{
    use HasFactory;

    public $timestamps = false;
}
