<?php

namespace Alive2212\LaravelReferralService;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class AliveReferralRecords extends Model
{
    protected $fillable = [
        'user_id',
        'processes_id'
    ];
}
