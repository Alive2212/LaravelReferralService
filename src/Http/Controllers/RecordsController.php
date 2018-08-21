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
    public static function referralgift($details)
    {
        /**
         * get last class & model
         */
        $previousClass = debug_backtrace()[1]['class'];
        $previousFunction = debug_backtrace()[1]['function'];
        /**
         * check for available gift
         */
        $aliveReferralRule = new AliveReferralRule;
        $availableClass = $aliveReferralRule->where(
            [
                ['class', '=', $previousClass],
                ['method', '=', $previousFunction],
            ])
            ->get();
//        return $rule;
        /**
         * check gifts rule
         */
        if (!is_null($availableClass[0]['rules'])) {
            return 0;
        }
        /**
         * get user details
         */
        $userID = $details['user_id'];
        $user = new User;
        $user = $user->where('id', '=', $userID)->get();
        $phoneNumber = $user[0]['phone_number'];
        $preRegister = new PreRegister;
        $promoterID = $preRegister->where('phone_number', '=', $phoneNumber)->get()[0]['user_id'];

        $forFindID = ['user_id' => $userID, 'promoter_id' => $promoterID];
        $processes = new Processes;
        $process = $processes->where('id','=','27')
            ->get();
        $callingClass = $process[0]['class'];
        $paramsClass = $process[0]['params'];
        call_user_func_array("$callingClass", [$forFindID[$paramsClass[0]], $paramsClass[1]]);
//        dd($process);


        return ($process);
    }
}
