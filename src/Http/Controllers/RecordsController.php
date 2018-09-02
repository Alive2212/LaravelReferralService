<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelReferralService\AliveReferralRule;
use Alive2212\LaravelReferralService\PreRegister;
use Alive2212\LaravelReferralService\Processes;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RecordsController extends Controller
{

    public function referralGift($details)
    {
        $availableClass = $this->findAvailableGift();
        if (!is_null($availableClass[0]['rules'])) {
            return null;
        }
        $userID = $details['user_id'];
        $promoterID = $this->getPromoterID($userID);
        $process = $this->getProcess($details);
        if ($details['user_type'] == $process['params'][0]){
            $class = $process['class'];
            $callInstance = new $class();
            return $callInstance->{$process['method']}($process['params'][0] , $process['params'][1]);
        }

    }

    public function findAvailableGift()
    {
        $previousClass = debug_backtrace()[2]['class'];
        $previousFunction = debug_backtrace()[2]['function'];
        $aliveReferralRule = new AliveReferralRule;
        $availableClass = $aliveReferralRule->where(
            [
                ['class', '=', $previousClass],
                ['method', '=', $previousFunction],
            ])
            ->get();
        return $availableClass;
    }

    public function getUserDetails($userID)
    {
        $user = new User;
        $user = $user->where('id', '=', $userID)->get();
        $phoneNumber = $user[0]['phone_number'];
        return $phoneNumber;
    }

    public function getPromoterID($userID)
    {
        $phoneNumber = $this->getUserDetails($userID);
        $preRegister = new PreRegister;
        $promoterID = $preRegister->where('phone_number', '=', $phoneNumber)->get()[0]['user_id'];
        return $promoterID;
    }

    public function getProcess($details)
    {
        $processes = new Processes;
        $process = $processes->where('id','=','1')
                ->first()->toArray();

        return $process;
    }
}
