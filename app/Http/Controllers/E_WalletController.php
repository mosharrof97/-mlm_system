<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Refer_bonus;
use App\Models\Balance;
use DB;

class E_WalletController extends Controller
{
    public function E_Wallet(Request $request)
    {
        // $test = User::calculation()->$fundTransfer;
        // dd($test);
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $refer_userData = User::where('refer_id', $UserId)->get();
        $userData = Transfer::join('users', 'users.id', '=', 'transfers.from_user')->where('to_user', $UserName)->where("transfer_wallet", "e_wallet")->groupBy()->get();
        $TransferDatas = Transfer::where('from_user', $UserId)->groupBy()->get();
        $ReceivedDatas = Transfer::where('to_user', $UserName)->groupBy()->get();
        
        $totelBalance = Balance::where('user_id', $UserId)->first();

        $transfer_E_wallet= Transfer::where('from_user', $UserId) ->where("transfer_wallet", "e_wallet")->sum('transfer_amount');
        $Received_E_wallet = Transfer::where('to_user', $UserName)->where("transfer_wallet", "e_wallet") ->sum('transfer_amount');

        $eWallet = Refer_bonus::where('user_id', $UserId)->sum('bonus_amount');
        
     

        return view('userDashboard.page.financial.my-e-wallet', compact(['totelBalance', 'TransferDatas', 'ReceivedDatas','transfer_E_wallet','Received_E_wallet','eWallet','userData','refer_userData']));
    }



    

}
