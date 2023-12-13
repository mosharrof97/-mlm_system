<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Refer_bonus;
use App\Models\Balance;
use DB;

class AdminTransferController extends Controller
{
    private $Balance;
    private $FundTransferDatas;
    private $FundReceivedDatas;
    private $userTransactions;
    private $depositBalance;
    private $fundTransfer;
    private $ReceivedFund;
    private $eWallet;
    private $eWalletTransfer;
    private $eWalletReceived;

    // public function __construct(Authenticatable $userModel)
    public function __construct()
    {
        $this->initializeData();
    }

    private function initializeData()
    {
        $this->alluser = User::get();
        $this->FundTransferDatas = $this->fundTransferDatas = Transfer::join('users', 'users.id', 'transfers.from_user');
        
        $this->Balance = Balance::get()->sum('balance_amount');
// dd($totelBalance);
        $this->depositBalance = Transaction::get()->sum('deposit_amount');
        $this->depositTransfer = Transfer::where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');


        $this->eWallet = Refer_bonus::join('users', 'users.id', 'refer_bonuses.user_id')->get();
        $this->eWalletTransfer = Transfer::where("transfer_wallet", "e_wallet")->sum('transfer_amount');
        
    }
    
    public function fundTransfer(Request $request)
    {        
        $this->initializeData();

        $this->userData = $this->FundTransferDatas ->where('username', 'LIKE', $request->from_user . '%') ->where('to_user', 'LIKE', $request->to_user . '%') ->get();
        //    dd( $depositBalance);
        return view('dashboard\page\financial\fund-transfer', [
            'Balance' => $this->Balance ,
            'FundTransferDatas' => $this->userData, 
            'depositBalance' => $this->depositBalance,
            'depositTransfer'=>$this->depositTransfer,
            'eWallet' => $this->eWallet,
            'eWalletTransfer' => $this->eWalletTransfer,
        ]);
    }


    
}
