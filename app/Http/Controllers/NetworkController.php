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
use DB;

class NetworkController extends Controller
{
    private $user;
    private $userId;
    private $userName;
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
        // $this->fundTransferDatas = Transfer::where('from_user', $this->userId)->groupBy()->get();
        // $this->fundReceivedDatas = Transfer::where('to_user', $this->userName)->groupBy('to_user')->get();
        // $this->userTransactions = Transaction::where('user_id', $this->user) ->where('transaction_status', 1)->get();
        // $this->depositBalance = $this->userTransactions->sum('transaction_amount');
        // $this->fundTransfer = Transfer::where('from_user', $this->user) ->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');
        // $this->receivedFund = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "deposit_wallet") ->sum('transfer_amount');
        $this->eWallet = Refer_bonus::where('user_id', $this->userId)->sum('bonus_amount');
        // $this->eWalletTransfer = Transfer::where('from_user', $this->user) ->where("transfer_wallet", "e_wallet")->sum('transfer_amount');
        // $this->eWalletReceived = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "e_wallet") ->sum('transfer_amount');
        // $this->secondRefer  = User::where('referral_code', $this->refer_user)->get();
    }

    public function index(){

        $this->initializeData();
        
        return view('userDashboard\page\network\network', [
            'refer_user'=>$this->refer_user,
            'totelBalance'=>$this->totelBalance, 
            'eWallet'=>$this->eWallet,
        ]);
    }
}