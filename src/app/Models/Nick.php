<?php

namespace App\Models;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class that manages data related to Nick model
 *
 * @property string $name
 * @property string $password
 * @property bool $is_active
 * @property Carbon $last_use
 * @property string $user_id
 *
 * @method find(string $id)
 * @method findOrFail(string $value)
 * @method create(array $data)
 * @method whereName(string $value)
 * @method static active(bool $true = true) Scope to retrieve active or inactive nicks
 */
class Nick extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'nicks';
    protected $fillable = ['name', 'password', 'is_active', 'last_use', 'user_id'];
    protected $dates = ['last_use'];
    protected $casts = ['is_active' => 'boolean'];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($q, bool $value = true)
    {
        return $q->where('is_active', $value);
    }
}
