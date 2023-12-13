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

class AdminE_walletController extends Controller
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
        // $this->fundTransferDatas = Transfer::join('users', 'users.id', 'transfers.from_user')->where('transfer_wallet', 'e_wallet')->get();
        $this->Refer_bonus = Refer_bonus::join('users', 'users.id', 'refer_bonuses.user_id');
        $this->eWalletTransfer = Transfer::where("transfer_wallet", "e_wallet")->sum('transfer_amount');
    }

    public function E_Wallet(Request $request)
    {
        $this->initializeData();

        $datas = $this->Refer_bonus 
        ->where('username', 'LIKE', $request->username . '%')
        ->get();

    //     $datas = $this->fundTransferDatas
    // ->where('username', 'LIKE', $request->from_user . '%')
    // ->Where('to_user', 'LIKE', $request->to_user . '%')
    // ->Where('to_user', 'LIKE', $request->date . '%')
    // ->get();
        // $fundTransferDatas = $this->fundTransferDatas->where('username', 'LIKE', $request->from_user . '%')->orwhere('username', 'LIKE', $request->to_user . '%')->orwhere('created_at', 'LIKE', $request->date . '%')->get();
        

        // if ($request->ajax()) {
        //     $datas =Transfer::join('users', 'users.id', 'transfers.from_user')->where('transfer_wallet', 'e_wallet')->where('username', 'LIKE', $request->from_user . '%')->orwhere('username', 'LIKE', $request->to_user . '%')->orwhere('created_at', 'LIKE', $request->date . '%')->get();
        //      //User::where('username', 'LIKE', $request->to_user . '%')->get();
        //     $output = "";
        //     if (count($datas) > 0) {
        //         foreach ($datas as $data) {
        //             $output .= '<li class=" bg-light shadow w-100 p-1 ">' . $data->username . '</li>';
        //         }
        //     } else {
        //         $output .= '<li> No Data Found</li>';
        //     }
        //     return $output;
        // }

        return view('dashboard\page\financial\my-e-wallet', [
            'totelBalance' => $this->userBalance, 
            'datas' => $datas, 
            'Refer_bonus' => $this->Refer_bonus ,
            'eWalletTransfer' => $this->eWalletTransfer ,
        ]);

    }
}
