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
        ]);
    }
    public function generate()
    {
        if (!is_null($referralCode = Input::get('q'))){
            $refPerson = $this->finduser($referralCode);
            return View::make('vendor.alive2212.referral', compact('refPerson'));
        }
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $countryCode = $user['country_code'];
        $countryCode = str_replace('+', '', $countryCode);
        $phoneNumber = $user['phone_number'];
        $forSerialize = [$countryCode, $phoneNumber];
        $serialized = serialize($forSerialize);
        $base64 = base64_encode($serialized);
        $url = URL::current().'?q='.urlencode($base64);
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
        $userName = $user[0]['name'];
        return $userName;
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
