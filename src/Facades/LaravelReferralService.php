<?php

namespace Alive2212\LaravelReferralService\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelReferralService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-referral-service';
    }
}
