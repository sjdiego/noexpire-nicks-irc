<?php

namespace App\Models;

use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class that manages data related to Config model
 *
 * @property string $key;
 * @property string $value;
 * @property string $type;
 */
class Config extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'config';
    protected $fillable = ['key', 'value', 'type'];

    /**
     * @param string $key
     * @return mixed
     */
    public function getByKey(string $key)
    {
        return $this->where('key', mb_strtolower($key))->firstOrFail();
    }

    public static function getValue(string $key, string $default = null)
    {
        $result = self::where('key', Str::slug($key, '.'))->first();

        return ($result && null === $default) ? $result->value : $default;
    }
}
