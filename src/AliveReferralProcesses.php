<?php

namespace Alive2212\LaravelReferralService;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $rule
 */
class AliveReferralProcesses extends Model
{
    protected $fillable = [
        'model',
        'method',
        'params',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rule()
    {
//        dd(15985);
        return $this->belongsTo(AliveReferralRule::class);

    }




}
