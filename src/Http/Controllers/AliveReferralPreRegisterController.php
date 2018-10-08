<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelReferralService\AliveReferralPreRegister;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class AliveReferralPreRegisterController extends Controller
{
    private $kaveUrl = 'https://api.kavenegar.com/v1/6A596E65546566704B7677554C334342516472574A413D3D/sms/send.json' ;
    public function create(Request $request)
    {
        if (is_null($request->input('phone_number'))) {
            return View::make(config('laravel-referral-service.download_view'));
        }
        $userPhoneNumber = $request->input('phone_number');
        if($request->input('user_number') == $userPhoneNumber){
            return View::make(config('laravel-referral-service.download_view'));
        }
        if (!is_null($this->userExistCheck($userPhoneNumber))) {
            return View::make(config('laravel-referral-service.download_exist_view'));
        }
        if (!is_null($this->preRegisterExistCheck($request))) {
            return View::make(config('laravel-referral-service.download_exist_view'));
        }
        $this->storePreRegister($request);
        return View::make(config('laravel-referral-service.download_view'));
    }

    /**
     * @param Request $request
     */
    public function sendSms(Request $request)
    {
        $smsJson = [
            'receptor' => $request->input('phone_number'),
            'message' => (config('laravel-referral-service.download_message'))
        ];
        $client = new Client();
        $client = $client->Post($this->kaveUrl, [
            'form_params' => $smsJson
        ]);
    }

    /**
     * @param Request $request
     */
    public function storePreRegister(Request $request)
    {
        $preRegisterData = [
            'user_id' => $request->input('user_id'),
            'phone_number' => $request->input('phone_number'),
            'country_code' => $request->input('country_code')
        ];
        $preRegister = new AliveReferralPreRegister();
        $preRegister = $preRegister->firstOrCreate($preRegisterData);
        $this->sendSms($request);
    }

    /**
     * @param $userPhoneNumber
     * @return mixed
     */
    public function userExistCheck($userPhoneNumber)
    {
        $user = new User();
        $userExist = $user->where('phone_number', '=', $userPhoneNumber)->first();
        return $userExist;
    }

    /**
     * @param Request $request
     * @return AliveReferralPreRegister
     */
    public function preRegisterExistCheck(Request $request)
    {
        $preRegister = new AliveReferralPreRegister();
        $preRegister = $preRegister->where('phone_number', '=', $request->input('phone_number'))->first();
        return $preRegister;
    }
}