<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Balance;


class UserTransactionController extends Controller
{
    private $alluser;
    private $userTransactions;
    private $userApprovedTransactions;
    private $userPendingTransactions;
    private $ApprovedBalance;
    private $pendingBalance;
    private $fundTransfer;
    private $receivedFund;
   

    // public function __construct(Authenticatable $userModel)
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $this->user = auth()->user();
        //     $this->userId = auth()->user()->id;
        //     $this->userName = $this->user->username;
        //     return $next($request);
        // });
        $this->initializeData();
    }

    private function initializeData()
    {

        $this->alluser = User::get();
        $this->userTransactions = Transaction::where('transaction_type','Deposit Wallet')->orderBy('transaction_id', 'DESC')->get();
        $this->userApprovedTransactions = Transaction::where('transaction_type','Deposit Wallet')->where('transaction_status', 1)->orderBy('transaction_id', 'DESC')->get();
        $this->userPendingTransactions = Transaction::where('transaction_type','Deposit Wallet')->where('transaction_status', 0)->orderBy('transaction_id', 'DESC')->get();
        $this->ApprovedBalance = $this->userApprovedTransactions->sum('transaction_amount');
        $this->pendingBalance = $this->userPendingTransactions->sum('transaction_amount');
    }
    

    public function deposit_wallet()
    {
        $this->initializeData();

        return view('dashboard\page\financial\deposit-wallet', [
            'userTransactions' => $this->userTransactions, 
            'ApprovedBalance' => $this->ApprovedBalance,
            'pendingBalance' => $this->pendingBalance, 
            'fundTransfer' => $this->fundTransfer  ,
            'receivedFund' => $this->receivedFund ,
         ]);
    }
    
    // public function deposit(Request $request)
    // {

    //     // DB::beginTransaction();
    //     //     try {
    //     // dd($request->All());
    //     $request->validate([
    //         'deposit' => ['required', 'numeric', 'between:1,99999999999999'],
    //         'deposit_method' => ['required'],
    //         'trxid' => ['required', 'unique:' . Transaction::class],
    //     ]);
    //     $userData = [
    //         'user_id' => Auth::User()->id,
    //         'transaction_type' => 'Deposit Wallet',
    //         'transaction_amount' => $request->deposit,
    //         'deposit_method' => $request->deposit_method,
    //         'trxid' => $request->trxid,
    //     ];
    //     // dd($user);
    //     Transaction::create($userData);

    //     return back();

    //     //     DB::commit();

    //     // } catch (Exception $e) {
    //     //     DB::rollback();
    //     //     throw $e;
    //     // }
    // }


    public function edit($id)
    {
        $transactions = Transaction::where('transaction_id', $id)->first();
        //    dd( $transactions);
        return view('dashboard\page\financial\approved-deposit-wallet', compact(['transactions']));
    }

    public function update(Request $request,  $id)
    {
        $transactions = Transaction::where('transaction_id', $id)->first();
        if ($transactions->transaction_status == 1) {
            return redirect(url('admin/deposit-wallet'));
        } else {
            $request->validate([
                'transaction_status' => ['required'],
            ]);
            
            DB::beginTransaction();
            try {
                $userData = [
                    'transaction_status' => $request->transaction_status,
                ];

                Transaction::where('transaction_id', $id)->update($userData);

                $rak = Balance::where('user_id', $request->user_id)->first();
                if ($request->transaction_status == 1) {
                    $data = [
                        // 'user_id' => $request->user_id,
                        'balance_amount' => $request->transaction_amount + $rak->balance_amount,
                    ];
                    Balance::where('user_id', $request->user_id)->update($data);
                }
                DB::commit();
                return redirect(url('admin/deposit-wallet'));
            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }


    
}
