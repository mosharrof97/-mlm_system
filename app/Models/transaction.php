<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory; 
    protected $fillable = [
        'user_id', 
        'transaction_type',
        'deposit_method',
        'trxid',
        'transaction_amount',
        'transaction_status',
      
       
    ];

    public function User(): HasMany
    {
        return $this->belongsTo(User::class);
    }

    public static function depositBalance(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $userTransactions = Transaction::where('user_id', $UserId) ->where('transaction_status', 1)->get(); 
        $depositBalance = $userTransactions->sum('transaction_amount');
        return $depositBalance;
    }
}
