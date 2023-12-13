<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'balance_amount',
    ];

    public static function Balance(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;
        
        $Balance = Balance::where('user_id', $UserId)->first();
        return $Balance;
    }
}

