<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refer_bonus extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bonus_amount',     
        'bonus_date',
    ];

    

    public static function eWallet(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $eWallet = Refer_bonus::where('user_id', $UserId)->sum('bonus_amount');
        
        return $eWallet;
    }
}
