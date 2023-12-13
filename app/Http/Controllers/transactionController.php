<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Balance;

class transactionController extends Controller
{
    public function deposit_wallet()
    {
        $User = Auth()->User();
        $UserId = $User->id;
        $UserName = $User->username;
        $totalBalance = Balance::where('user_id', $UserId)->first();

        $transactions = Transaction::join('users','users.id','=','transactions.user_id')->where('user_id', $UserId)->orderBy('transaction_id', 'desc')->groupBy()->paginate(20);;
        $depositBalance = $transactions ->where('transaction_status', 1)->sum('transaction_amount');
        $transferBalance = Transfer::where('from_user', $UserId)->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');
        $ReceivedBalance = Transfer::where('to_user' , $UserName)->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');

        return view('userDashboard\page\financial\deposit-wallet', compact(['transactions', 'depositBalance','totalBalance', 'transferBalance','ReceivedBalance' ]));
    }


    public function deposit(Request $request)
    {

        // DB::beginTransaction();
        //     try {
        // dd($request->All());
        $request->validate([
            'deposit' => ['required', 'numeric', 'between:1,99999999999999'],
            'deposit_method' => ['required'],
            'trxid' => ['required', 'unique:' . Transaction::class],
        ]);
        $userData = [
            'user_id' => Auth::User()->id,
            'transaction_type' => 'Deposit Wallet',
            'transaction_amount' => $request->deposit,
            'deposit_method' => $request->deposit_method,
            'trxid' => $request->trxid,
        ];
        // dd($user);
        Transaction::create($userData);

        return back();

        //     DB::commit();

        // } catch (Exception $e) {
        //     DB::rollback();
        //     throw $e;
        // }
    }


    // public function edit($id)
    // {
    //     $transactions = Transaction::where('transaction_id', $id)->first();
    //     //    dd( $transactions);
    //     return view('userDashboard\page\financial\approved-deposit-wallet', compact(['transactions']));
    // }

    // public function update(Request $request,  $id)
    // {
    //     $transactions = Transaction::where('transaction_id', $id)->first();
    //     if ($transactions->transaction_status == 1) {
    //         return redirect(url('deposit-wallet'));
    //     } else {
    //         $request->validate([
    //             'transaction_status' => ['required'],
    //         ]);


    //         $userData = [
    //             'transaction_status' => $request->transaction_status,
    //         ];


    //         Transaction::where('transaction_id', $id)->update($userData);

    //         $rak = Balance::where('user_id', $request->user_id)->first();
    //         if ($request->transaction_status == 1) {
    //             $data = [
    //                 // 'user_id' => $request->user_id,
    //                 'balance_amount' => $request->transaction_amount + $rak->balance_amount,
    //             ];
    //             Balance::where('user_id', $request->user_id)->update($data);
    //         }
    //         return redirect(url('deposit-wallet'));
    //     }
    // }
}
