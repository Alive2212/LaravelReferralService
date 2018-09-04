<?php

namespace Alive2212\LaravelReferralService;

use Illuminate\Database\Eloquent\Model;

class AliveReferralRule extends Model
{
    public function process()
    {
        return $this->hasMany(AliveReferralProcesses::class);

    }
}
