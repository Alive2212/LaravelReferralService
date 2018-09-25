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
        $userId = $this->findUserId($details);
        $availableClass = $this->findAvailableGift();
        if (!is_null($availableClass[0]['rules'])) {
            return null;
        }

        $promoterId = $this->getPromoterID($userId);
        if ($promoterId == null) {
            return null;
        }
        $checkUser = $this->checkUserForGift($userId, $promoterId);
        if (!is_null($checkUser)) {
            return null;
        }
        $processes = $this->getProcess($availableClass[0]['id']);

        $this->callFunction($processes, $userId, $promoterId);

    }


    public function checkUserForGift($userId, $promoterId)
    {
        $user = new AliveReferralRecords();
        $checkUser = $user->where('user_id', '=', $userId)
            ->where('promoter_id', '=' , $promoterId)
            ->get()->first();
        return $checkUser;

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

    /**
     * @param $processes
     * @param $userId
     * @param $promoterId
     */
    public function callFunction($processes, $userId, $promoterId)
    {
        foreach ($processes as $process) {
            $params = json_decode($process['params']);
            $variableString = str_replace_first('_id', 'Id', $params[0]);
            $callingId = ${"$variableString"};
//            dd($id);
            if ($callingId === $userId) {
                $this->addUserToDone($userId, $process['id']);
            }
            $object = new LaravelWalletService();
            $object->credit(
                $callingId,
                $params[1],
                'referral gift',
                'referral user',
                ""
            );
        }
    }

    public function addUserToDone($userId, $processesId)
    {
//        dd($userId);
        $user = new AliveReferralRecords();
        $userData = [
            'user_id' => $userId,
            'processes_id' => $processesId
        ];
        $userDone = $user->firstOrCreate($userData);
        return;
    }

    /**
     * @param $details
     * @return mixed
     */
    public function findUserId($details)
    {
        if (isset($details['customer_id'])) {
            $userId = $details['customer_id'];
        } else {
            $user = new User();
            $user = $user->where('phone_number', '=', $details['phone_number'])->get();
            $userId = $user[0]['id'];

        }
        return $userId;
    }
}
