<?php

namespace Alive2212\LaravelReferralService;

use Illuminate\Database\Eloquent\Model;

class AliveReferralPreRegister extends Model
{
    protected $fillable = [
        'user_id',
        'phone_number',
        'country_code',
    ];
}
