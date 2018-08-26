<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelReferralService\PreRegister;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PreRegisterController extends Controller
{

    public static function create()
    {
        $preRegister =
            ['user_id' => input::post('user_id'),
                'phone_number' => input::post('phone_number'),
                'country_code' => input::post('country_code')];
        $preRegister = PreRegister::firstOrCreate($preRegister);
        return $preRegister;
    }
}