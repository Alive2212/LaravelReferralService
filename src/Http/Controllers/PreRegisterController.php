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
            ['user_id' => '123888',
                'phone_number' => '3213123',
                'country_code' => '123213321'];
        $preRegister = PreRegister::firstOrCreate($preRegister);
        return 0;
        $user_id = input::get('user_id');
        $phoneNumber = input::get('phone_number');
        $countryCode = input::get('country_code');
//        return($phoneNumber);
        $preRegister =
            ['user_id' => $user_id,
                'phone_number' => $phoneNumber,
                'country_code' => $countryCode];
        $preRegister = PreRegister::firstOrCreate($preRegister);

        return $preRegister;
    }
}