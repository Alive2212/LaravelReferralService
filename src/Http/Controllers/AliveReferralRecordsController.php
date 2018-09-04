<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use Alive2212\LaravelReferralService\AliveReferralRecords;
use Alive2212\LaravelReferralService\AliveReferralRule;
use Alive2212\LaravelReferralService\AliveReferralPreRegister;
use Alive2212\LaravelReferralService\AliveReferralProcesses;
use Alive2212\LaravelWalletService\LaravelWalletService;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AliveReferralRecordsController extends Controller
{

    public function referralGift($details)
    {
        $userId = $details['customer_id'];
        $checkUser = $this->checkUserForGift($userId);
        if (!is_null($checkUser)) {
            return null;
        }
//        dd(65);
        $availableClass = $this->findAvailableGift();
        if (!is_null($availableClass[0]['rules'])) {
            return null;
        }

        $promoterId = $this->getPromoterID($userId);
        if ($promoterId == null) {
            return null;
        }
        $processes = $this->getProcess($availableClass[0]['id']);

        foreach ($processes as $process) {
            $params = json_decode($process['params']);
            if ($params[0] === 'user-id') {
//                dd($process['id']);
                $this->addUserToDone($userId,$process['id']);
                $object = new LaravelWalletService();
                $object->credit($userId, $params[1], 'referral gift', 'referral user', "");
            } elseif ($params[0] === 'promoter-id') {
                $object = new LaravelWalletService();
                $object->credit($promoterId, $params[1], 'referral gift', 'referral promoter', "");
            } else {
                return;
            }
        }

    }

    public function addUserToDone($userId , $processesId)
    {
        $user = new AliveReferralRecords();
        $userData = [
            'user_id' => $userId,
            'processes_id' => $processesId
        ];
        $userDone = $user->firstOrCreate($userData);
        return ;
    }

    public function checkUserForGift($userId)
    {
        $user = new AliveReferralRecords();
        $user = $user->where('user_id', '=', $userId)
            ->get()->first();
        return $user;

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
//        dd($availableClass);
        return $availableClass;
    }

    public function getUserDetails($userID)
    {
        $user = new User;
        $user = $user->where('id', '=', $userID)->get();
        $phoneNumber = $user[0]['phone_number'];

//        dd($phoneNumber);
        return $phoneNumber;
    }

    public function getPromoterID($userID)
    {
        $phoneNumber = $this->getUserDetails($userID);
        $preRegister = new AliveReferralPreRegister;
        $promoterID = $preRegister->where('phone_number', '=', $phoneNumber)->get();
        if (!is_null($promoterID->first())) {
            return $promoterID[0]['user_id'];
        } else {
            return null;
        }
    }

    public function getProcess($rule_id)
    {
        $processes = new AliveReferralProcesses;
        $process = $processes->where('rule_id', '=', "$rule_id")
            ->get()->toArray();
        return $process;
    }
}
