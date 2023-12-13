<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_user',
        'transfer_amount',
        'transfer_wallet',
        'to_user',
        'transfer_status',       
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function FundTransferDatas(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $FundTransferDatas = Transfer::where('from_user', $UserId)->groupBy()->get();
        return $FundTransferDatas;
    }

    public static function FundReceivedDatas(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $FundReceivedDatas = Transfer::where('to_user', $UserName)->groupBy()->get();
        return $FundReceivedDatas;
    }
   
    public static function fundTransfer(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $fundTransfer = Transfer::where('from_user', $UserId) ->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');
        
        return $fundTransfer;
    }

    public static function ReceivedFund(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $ReceivedFund = Transfer::where('to_user', $UserName)->where("transfer_wallet", "deposit_wallet") ->sum('transfer_amount');

        return $ReceivedFund;
    }

    public static function eWalletTransfer(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $eWalletTransfer = Transfer::where('from_user', $UserId) ->where("transfer_wallet", "e_wallet")->sum('transfer_amount');
       
        return $eWalletTransfer;
    }

    public static function eWalletReceived(){
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $eWalletReceived = Transfer::where('to_user', $UserName)->where("transfer_wallet", "e_wallet") ->sum('transfer_amount');
       
        return $eWalletReceived;
    }
}
