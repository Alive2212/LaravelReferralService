<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

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
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $countryCode = $user['country_code'];
        $countryCode = str_replace('+', '', $countryCode);
        $phoneNumber = $user['phone_number'];
        $forSerialize = [$countryCode, $phoneNumber];
        $serialized = serialize($forSerialize);
        $base64 = base64_encode($serialized);
        $url = URL::current().'?q='.$base64;
        $urlCode = urlencode($url);
        return $urlCode;

    }

    /**
     * @return string
     */
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
