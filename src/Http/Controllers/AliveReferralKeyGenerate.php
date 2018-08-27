<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelSmartResponse\ResponseModel;
use Alive2212\LaravelSmartResponse\SmartResponse\SmartResponse;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AliveReferralKeyGenerate extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api'
        ])->except('userPage');
    }

    public function userPage()
    {   $referralCode = Input::get('q');
        $detail = $this->findUser($referralCode);
        $refPerson = $detail['user_name'];
        $userId = $detail['user_id'];
        return View::make('vendor.alive2212.referral', compact(['refPerson', 'userId']));
    }

    public function generate()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $countryCode = str_replace('+', '', $user['country_code']);
        $forSerialize = [$countryCode, $user['phone_number']];
        $url = ['url' => (URL::current() . '?q=' . urlencode(base64_encode(serialize($forSerialize))))];
        $response = new ResponseModel();
        $response->setMessage(config('laravel-referral-service.default_message'));
        $response->setStatus(true);
        $response->setData(collect($url));
        return SmartResponse::response($response);
    }

    /**
     * @param $referralCode
     * @return string
     */
    public function findUser($referralCode)
    {
        $deserialize = unserialize(base64_decode(urldecode($referralCode)));
        $phoneNumber = $deserialize[1];
        $user = new User();
        $user = $user->where('phone_number', '=', $phoneNumber)->get();
        $detail = ['user_name' => $user[0]['name'], 'user_id' => $user[0]['id'],];
        return $detail;
    }

}
