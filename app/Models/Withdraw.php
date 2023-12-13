<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'withdraw_type',
        'withdraw_method',
        'withdraw_account',
        'withdraw_amount',
        'withdraw_status',
    ];
}
