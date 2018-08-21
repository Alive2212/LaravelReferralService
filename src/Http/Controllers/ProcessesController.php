<?php

namespace Alive2212\LaravelReferralService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function referral()
    {
        $details = ['model' => 'call_user_func_array', 'method' => 'updating', 'user_id' => '3'];
        $ddd = RecordsController::referralgift($details);
        return $ddd;
    }
    
}
