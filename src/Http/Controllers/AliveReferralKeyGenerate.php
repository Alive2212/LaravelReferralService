<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelSmartResponse\ResponseModel;
use Alive2212\LaravelSmartResponse\SmartResponse\SmartResponse;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AliveReferralKeyGenerate extends Controller
{
    protected $routeAddress = '';

    public function __construct()
    {
        $this->middleware([
            'auth:api'
        ])->except('userPage');
    }

    public function userPage()
    {   $referralCode = Input::get('q');
        $detail = $this->finduser($referralCode);
        $refPerson = $detail['userName'];
        $userId = $detail['userId'];
//        dd($refPerson);
        return View::make('vendor.alive2212.referral', compact(['refPerson', 'userId']));
    }
    public function generate()
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $countryCode = $user['country_code'];
        $countryCode = str_replace('+', '', $countryCode);
        $phoneNumber = $user['phone_number'];
        $forSerialize = [$countryCode, $phoneNumber];
        $url = URL::current() . '?q=' . urlencode(base64_encode(serialize($forSerialize)));
        $url = ['url' => $url];
        $response = new ResponseModel();
        $response->setMessage('همه چی درسته');
        $response->setStatus(true);
        $response->setData(collect($url));
        return SmartResponse::response($response);
    }

    /**
     * @return string
     */
    public function finduser($referralcode)
    {
        $urldecoded = urldecode($referralcode);
        $base64decoded = base64_decode($urldecoded);
        $deserialize = unserialize($base64decoded);
        $phoneNumber = $deserialize[1];
        $user = new User();
        $user = $user->where('phone_number', '=', $phoneNumber)->get();
        $userId = $user[0]['id'];

        $userName = $user[0]['name'];
        $detail = [
            'userName' => $userName,
            'userId' => $userId,
        ];
        return $detail;
    }

    public function getRouteAddress()
    {
        return $this->routeAddress;
    }

    /**
     * @param string $routeAddress
     */
    public function setRouteAddress($routeAddress)
    {
        $this->routeAddress = $routeAddress;
    }
}
