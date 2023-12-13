<?php

namespace App\Http\Controllers;
    
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
use App\Models\Withdraw;
use DB;

class WithdrawController extends Controller
{
    private $user;
    private $userId;
    private $userName;
    private $Balance;
    private $transactions;
    private $depositBalance;
    private $withdraw;
    private $withdrawBalance;
    private $eWallet;
    private $eWalletTransfer;
    private $eWalletReceived;
    private $totaleWallet;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->userId = $this->user->id;
            $this->userName = $this->user->username;
            return $next($request);
        });
        $this->initializeData();
    }

    private function initializeData()
    {
        $this->referUser = User::where('refer_id', $this->userId)->groupBy()->get();
        $this->balance = Balance::where('user_id', $this->userId)->first();
        $this->userTransactions = Transaction::where('user_id', $this->userId)->where('transaction_status', 1)->get();

        $this->withdraw = Withdraw::join('users', 'users.id', '=', 'withdraws.user_id')
            ->where('user_id', $this->userId)
            ->orderBy('withdraw_id', 'desc')
            ->groupBy()
            ->paginate(20);

        $this->fundTransferDatas = Transfer::where('from_user', $this->userId)->groupBy()->get();
        $this->fundReceivedDatas = Transfer::where('to_user', $this->userName)->groupBy('to_user')->get();

        $this->depositBalance = $this->userTransactions->sum('transaction_amount');
        $this->fundTransfer = Transfer::where('from_user', $this->userId)->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');
        $this->receivedFund = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');

        $this->eWallet = Refer_bonus::where('user_id', $this->userId)->sum('bonus_amount');
        $this->eWalletTransfer = Transfer::where('from_user', $this->userId)->where("transfer_wallet", "e_wallet")->sum('transfer_amount');
        $this->eWalletReceived = Transfer::where('to_user', $this->userName)->where("transfer_wallet", "e_wallet")->sum('transfer_amount');

        $this->withdrawBalance = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 1)->sum('withdraw_amount');
        $this->pendingWithdraw = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 0)->sum('withdraw_amount');
        $this->withdrawDeposit = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 1)->where('withdraw_type', 'deposit wallet')->sum('withdraw_amount');
        $this->withdrawBonus = Withdraw::where('user_id', $this->userId)->where('withdraw_status', 1)->where('withdraw_type', 'E-wallet')->sum('withdraw_amount');
    }

    public function Withdraw()
    {
        $this->initializeData();
        $totalDeposit = ($this->depositBalance + $this->receivedFund) - ($this->fundTransfer + $this->withdrawDeposit);
        $totalEwallet = ($this->eWallet + $this->eWalletReceived) - ($this->eWalletTransfer + $this->withdrawBonus);

       
        return view('userDashboard.page.financial.withdraw', [
            'referUser' => $this->referUser,
            'balance' => $this->balance,
            'fundTransferDatas' => $this->fundTransferDatas,
            'fundReceivedDatas' => $this->fundReceivedDatas,

            'fundTransfer' => $this->fundTransfer,
            'receivedFund' => $this->receivedFund,
            'depositBalance' => $this->depositBalance,
            'totalDeposit' => $totalDeposit,

            'eWallet' => $this->eWallet,
            'eWalletTransfer' => $this->eWalletTransfer,
            'eWalletReceived' => $this->eWalletReceived,
            'totalEwallet' => $totalEwallet,

            'withdraw' => $this->withdraw,
            'withdrawBalance' => $this->withdrawBalance,
            'pendingWithdraw' => $this->pendingWithdraw,
            'withdrawDeposit' => $this->withdrawDeposit,
            'withdrawBonus' => $this->withdrawBonus,
        ]);
    }

    public function Withdraw_amount(Request $request){
        $this->initializeData();
        $totalDeposit = ($this->depositBalance + $this->receivedFund) - ($this->fundTransfer + $this->withdrawDeposit);
        $totaleWallet = ($this->eWallet + $this->eWalletReceived) - ($this->eWalletTransfer + $this->withdrawBonus);
    
        $request->validate([
            'amount' => ['required', 'numeric', 'between:1,99999999999999'],
            'method' => ['required'],
            'account' => ['required'],
            'wallet' => ['required'], // Add validation for the wallet type
        ]);
    
        $userData = [
            'user_id' => Auth::user()->id,
            'withdraw_amount' => $request->amount,
            'withdraw_type' => $request->wallet,
            'withdraw_method' => $request->method,
            'withdraw_account' => $request->account,
        ];
    
        if ($request->wallet == 'deposit wallet') {
            $minDepositBalance = 100;
            // dd($totalDeposit);
            if ($totalDeposit > $minDepositBalance && $totalDeposit > $request->amount) {
                Withdraw::create($userData);
                return back()->with('success', 'Withdraw Successful!');
            } else {
                return back()->with('error', $totalDeposit > $minDepositBalance ? 'Insufficient Balance!' : 'No Deposit Balance');
            }
        } elseif ($request->wallet == 'E-wallet') {
            $minEwalletBalance = 50;
            if ($totaleWallet > $minEwalletBalance && $totaleWallet > $request->amount) {
                Withdraw::create($userData);
                return back()->with('success', 'Withdraw Successful!');
            } else {
                return back()->with('error', $totaleWallet > $minEwalletBalance ? 'Insufficient Balance!' : 'No Deposit Balance');
            }
        } else {
            return back()->with('error', 'Please select deposit wallet');
        }
    }
}
