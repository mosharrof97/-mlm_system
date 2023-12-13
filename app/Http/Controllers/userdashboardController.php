<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Refer_bonus;
use App\Models\Balance;
use App\Models\Withdraw;
use DB;

class userdashboardController extends Controller
{
    private $user;
    private $userId;
    private $userName;
    private $refer_user;
    // private $totelBalance;
    // private $fundTransferDatas;
    // private $fundReceivedDatas;
    // private $userTransactions;
    // private $depositBalance;
    // private $fundTransfer;
    // private $receivedFund;
    // private $eWallet;
    // private $eWalletTransfer;
    // private $eWalletReceived;

    // public function __construct(Authenticatable $userModel)
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->userId = auth()->user()->id;
            $this->userName = $this->user->username;
            return $next($request);
        });
        $this->initializeData();
    }

    private function initializeData()
    {
        $this->refer_user = User::where('refer_id', $this->userId)->groupBy()->get();
        $this->totelBalance = Balance::where('user_id', $this->userId)->first(); 
        $this->userTransactions = Transaction::where('user_id', $this->userId) ->where('transaction_status', 1)->get();
        $this->withdraw = Withdraw::join('users','users.id','=','withdraws.user_id')->where('user_id', $this->userId)->orderBy('withdraw_id', 'desc')->groupBy()->paginate(20);

        $this->fundTransferDatas = Transfer::where('from_user', $this->userId)->groupBy()->get();
        $this->fundReceivedDatas = Transfer::where('to_user', $this->userName)->groupBy('to_user')->get();
        $this->depositBalance = $this->userTransactions->sum('transaction_amount');
        $this->fundTransfer = Transfer::where('from_user', $this->userId) ->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');
        $this->receivedFund = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "deposit_wallet") ->sum('transfer_amount');
        
        $this->eWallet = Refer_bonus::where('user_id', $this->userId)->sum('bonus_amount');
        $this->eWalletTransfer = Transfer::where('from_user', $this->userId) ->where("transfer_wallet", "e_wallet")->sum('transfer_amount');
        $this->eWalletReceived = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "e_wallet") ->sum('transfer_amount');

        
        $this->withdrawBalance = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 1)->sum('withdraw_amount');  
        $this->PendingWithdraw = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 0)->sum('withdraw_amount');  
        $this->withdrawDeposit = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 1)->where('withdraw_type','deposit wallet')->sum('withdraw_amount');  
        $this->withdrawBonus = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 1)->where('withdraw_type','E-wallet')->sum('withdraw_amount');  

    }
    public function dashboard(){
        // dd($this->userTransactions);
        // dd($this->userId);
        $this->initializeData();

        $totalDeposit = ($this->depositBalance + $this->receivedFund) - ($this->fundTransfer + $this->withdrawDeposit);
        $totaleWallet = ($eWallet + $eWalletReceived) - ($eWalletTransfer + $withdrawBalance);
        
        return view('userDashboard\page\user-dashboard', [
            'refer_user'=>$this->refer_user,
            'Balance'=>$this->totelBalance, 
            'FundTransferDatas'=>$this->fundTransferDatas, 
            'FundReceivedDatas'=>$this->fundReceivedDatas,

            'fundTransfer'=>$this->fundTransfer,
            'ReceivedFund'=>$this->receivedFund,
            'depositBalance'=>$this->depositBalance, 
            'totalDeposit'=> $totalDeposit,

            'eWallet'=>$this->totaleWallet,
            'eWalletTransfer'=>$this->eWalletTransfer,
            'eWalletReceived'=>$this->eWalletReceived, 

            'withdrawBalance'=> $this->withdrawBalance,
            'PendingWithdraw'=> $this->PendingWithdraw,
            'withdrawDeposit'=>$this->withdrawDeposit,
            'withdrawBonus'=>$this->withdrawBonus,
        ]);
    }
    

}
