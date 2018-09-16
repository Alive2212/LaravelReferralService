<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelReferralService\AliveReferralPreRegister;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class AliveReferralPreRegisterController extends Controller
{
    private $kaveUrl = 'https://api.kavenegar.com/v1/6A596E65546566704B7677554C334342516472574A413D3D/sms/send.json' ;
    public function create(Request $request)
    {
        $smsJson = [
            'receptor' => $request->input('phone_number'),
            'message' => (config('laravel-referral-service.download_message'))
        ];
        $preRegisterData = [
            'user_id' => $request->input('user_id'),
            'phone_number' => $request->input('phone_number'),
            'country_code' => $request->input('country_code')
        ];
        $preRegister = new AliveReferralPreRegister();
        $preRegister = $preRegister->firstOrCreate($preRegisterData);
        $client = new Client();
        $client = $client->Post($this->kaveUrl, [
            'form_params' => $smsJson
        ]);
        return View::make(config('laravel-referral-service.download_view'));
    }
}