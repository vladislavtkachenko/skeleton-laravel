<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Config
 *
 * @property int $id
 * @property string $title
 * @property string $key
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Config whereValue($value)
 * @mixin \Eloquent
 */
class Config extends Model
{
    public $timestamps = false;
}
