<?php

namespace Alive2212\LaravelReferralService;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Processes extends Model
{
    protected $fillable = [
        'model',
        'method',
        'params',
    ];
    protected $casts = [
        'params' => 'array'
    ];


}
