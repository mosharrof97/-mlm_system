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

class dashboardController extends Controller
{

    private $user;
    private $userId;
    private $userName;
    // private $Balance;
    // private $fundTransferDatas;
    // private $fundReceivedDatas;
    // private $userTransactions;
    // private $depositBalance;
    // private $fundTransfer;
    // private $receivedFund;
    // private $eWallet;
    // private $eWalletTransfer;
    // private $eWalletReceived;

    // private $withdraw;
    // private $PendingWithdraw;

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

        $this->alluser = User::where('role_id', 3)->get();
        $this->Balance = Balance::get()->sum('balance_amount'); 

        $this->userTransactions = Transaction::where('transaction_status', 1)->get();
        $this->userPendingTransactions = Transaction::where('transaction_status', 0)->get();
        $this->depositBalance = $this->userTransactions->sum('transaction_amount');
        $this->pendingBalance = $this->userPendingTransactions->sum('transaction_amount');

        // $this->fundTransferDatas = Transfer::where('from_user', $this->userId)->groupBy()->get();
        // $this->fundReceivedDatas = Transfer::where('to_user', $this->userName)->groupBy('to_user')->get();
        // $this->fundTransfer = Transfer::where('from_user', $this->user) ->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');
        // $this->receivedFund = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "deposit_wallet") ->sum('transfer_amount');
        
        $this->bonus = Refer_bonus::get();
        // $this->eWalletTransfer = Transfer::where('from_user', $this->user) ->where("transfer_wallet", "e_wallet")->sum('transfer_amount');
        // $this->eWalletReceived = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "e_wallet") ->sum('transfer_amount');

        $this->withdraw = Withdraw::join('users','users.id','=','withdraws.user_id')->orderBy('withdraw_id', 'desc')->groupBy()->paginate(20);
        $this->withdrawBalance = Withdraw::where('withdraw_status', 1)->get();  
        $this->PendingWithdraw = Withdraw::where('withdraw_status', 0)->get();  
        $this->withdrawDeposit = Withdraw::where('withdraw_status', 1)->where('withdraw_type','deposit wallet')->get();  
        $this->withdrawBonus = Withdraw::where('withdraw_status', 1)->where('withdraw_type','E-wallet')->get();  
        
    }
    public function dashboard(){
   
        $this->initializeData();
        return view('dashboard.page.dashboard', [
            'alluser'=>$this->alluser,
            'Bonus'=>$this->bonus,
            'Balance'=>$this->Balance, 
            
            'depositBalance'=>$this->depositBalance, 
            'pendingBalance'=>$this->pendingBalance, 
            'withdrawBalance'=> $this->withdrawBalance,
            'PendingWithdraw'=> $this->PendingWithdraw,
            'withdrawDeposit'=>$this->withdrawDeposit,
            'withdrawBonus'=>$this->withdrawBonus,
            
        ]);
    }
    



    // public function dashboard(){
        
    //     // $point = Networks::where('referral_user_id', refer_users::user_id)->orwhere('user_id', refer_users::user_id)->count();
    //     return view('dashboard.page.dashboard');
    // }
}
