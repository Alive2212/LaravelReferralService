<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelReferralService\PreRegister;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class PreRegisterController extends Controller
{

    /**
     * @return mixed
     */
    public static function create(Request $request)
    {
        $preRegisterData =
            ['user_id' => $request->input('user_id'),
                'phone_number' => $request->input('phone_number'),
                'country_code' => $request->input('country_code')];
        $preRegister = new PreRegister();
        $preRegister = $preRegister->firstOrCreate($preRegisterData);
        return View::make(config('laravel-referral-service.download_view'));
    }
}