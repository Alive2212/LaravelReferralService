<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AliveReferralProcessesController extends Controller
{
    public function referral()
    {
        $details = ['model' => 'call_user_func_array', 'method' => 'updating', 'user_id' => '2' ,'user_type' => 'user-id'];
        $referralGift = new AliveReferralRecordsController();
        $ddd = $referralGift->referralGift($details);
        return $ddd;
    }

    public function test()
    {
        return 'pooya';
    }
}
