<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
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

class AdminNetworkController extends Controller
{
    private $refer_user;
    private $totelBalance;
    private $fundTransferDatas;
    private $fundReceivedDatas;
    private $userTransactions;
    private $depositBalance;
    private $fundTransfer;
    private $receivedFund;
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
        $this->userBalance = Balance::get()->sum('balance_amount'); 
        $this->fundTransferDatas = Transfer::join('users', 'users.id', 'transfers.from_user')->where('transfer_wallet', 'e_wallet');
        
        $this->Refer_bonus = Refer_bonus::join('users', 'users.id', 'refer_bonuses.user_id');
        $this->eWalletTransfer = Transfer::where("transfer_wallet", "e_wallet")->sum('transfer_amount');
    }

    public function Network(Request $request)
    {
        $this->initializeData();

        $datas = $this->Refer_bonus 
        ->where('username', 'LIKE', $request->username . '%')
        ->paginate(20);

        return view('dashboard.page.network.network', [
            'totelBalance' => $this->userBalance, 
            'datas' => $datas, 
            'Refer_bonus' => $this->Refer_bonus ,
            'eWalletTransfer' => $this->eWalletTransfer ,
        ]);

    }
}


