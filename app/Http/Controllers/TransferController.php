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

class TransferController extends Controller
{
    public function fundTransfer(Request $request)
    {
        $user = Auth()->user();
        $UserId = $user->id;
        $UserName = $user->username;

        $FundTransferDatas = Transfer::FundTransferDatas();
        $FundReceivedDatas = Transfer::FundReceivedDatas();
        $Balance = Balance::Balance();
// dd($totelBalance);
        $depositBalance = Transaction::depositBalance();

        $fundTransfer = Transfer::fundTransfer();
        $ReceivedFund = Transfer::ReceivedFund();

        $eWallet = Refer_bonus::eWallet();
        $eWalletTransfer = Transfer::eWalletTransfer();
        $eWalletReceived = Transfer::eWalletReceived();
        // $totaleWallet= ($eWallet + $eWalletReceived) - $eWalletTransfer;
        
        
// dd(($depositBalance+$ReceivedFund)-$fundTransfer);

        if ($request->ajax()) {
            $datas = User::where('username', 'LIKE', $request->to_user . '%')->get();
            $output = "";
            if (count($datas) > 0) {
                foreach ($datas as $data) {
                    $output .= '<li class=" bg-light shadow w-100 p-1 ">' . $data->username . '</li>';
                }
            } else {
                $output .= '<li> No Data Found</li>';
            }
            return $output;
        }
        //    dd( $depositBalance);
        return view('userDashboard\page\financial\fund-transfer', compact(['Balance','FundTransferDatas', 'FundReceivedDatas','fundTransfer','ReceivedFund','depositBalance','eWallet', 'eWalletTransfer', 'eWalletReceived']));
    }


    public function transferred(Request $request)
    {
        
        $User = Auth()->User();
        $UserId = $User->id;
        $UserName = $User->username;
        $userTransactions = Transaction::where('user_id', $UserId) ->where('transaction_status', 1)->get();        
        $depositBalance = $userTransactions->sum('transaction_amount');

        $fundTransfer = Transfer::where('from_user', $UserId) ->where("transfer_wallet", "deposit_wallet")->sum('transfer_amount');
        $ReceivedFund = Transfer::where('to_user', $UserName)->where("transfer_wallet", "deposit_wallet") ->sum('transfer_amount');
        $totalBalance = ($depositBalance + $ReceivedFund) - $fundTransfer;

        $eWallet = Refer_bonus::where('user_id', $UserId)->sum('bonus_amount');
        $eWalletTransfer = Transfer::where('from_user', $UserId) ->where("transfer_wallet", "e_wallet")->sum('transfer_amount');
        $eWalletReceived = Transfer::where('to_user', $UserName)->where("transfer_wallet", "e_wallet") ->sum('transfer_amount');
        $totaleWallet= ($eWallet + $eWalletReceived) - $eWalletTransfer;


        if( $request->transfer_wallet == "deposit_wallet"){
            // dd($request->transfer_wallet);
            if ($totalBalance >= $request->transfer_amount) {
                // dd($request->transfer_amount);
                if ($request->to_user !== $UserName) {
                    // dd($request->to_user);
                    
                    // If the total balance is sufficient for the transfer, proceed with the transfer.
                    try {
                        // Begin a database transaction.
                        DB::beginTransaction();
                        
                            $request->validate([
                                'transfer_amount' => ['required', 'numeric', 'between:1,99999999999999'],
                                'transfer_wallet' => ['required'],
                                'to_user' => ['required'],
                            ]);

                            $userData = [
                                'from_user' => $UserId,
                                'transfer_amount' => $request->transfer_amount,
                                'transfer_wallet' => $request->transfer_wallet,
                                'to_user' => $request->to_user,
                            ];

                            Transfer::create($userData);

                        
                            $balance = Balance::where('user_id', $UserId)->first();
                            $data = [
                                'balance_amount' => $balance->balance_amount - $request->transfer_amount,
                            ];
                            Balance::where('user_id', $UserId)->update($data);


                            $toUser = User::where('username', $request->to_user)->first();
                            $toUserbalance = Balance::where('user_id', $toUser->id )->first();
                            $data = [
                                'balance_amount' => $toUserbalance->balance_amount + $request->transfer_amount,
                            ];
                            Balance::where('user_id', $toUser->id)->update($data);


                            DB::commit();
                    } catch (Exception $e) {
                        // Rollback the transaction if an exception occurs.
                        DB::rollback();
                        throw $e; // Rethrow the exception after rolling back.
                        
                    }
                } else {
                    return back()->with('error', $request->to_user.' is Admin');
                }
            } else {
                return back()->with('error', ' No Deposit Balance');
            }

        } else{

            if ($totaleWallet >= $request->transfer_amount) {
                if ($request->to_user !== $UserName) {
                    try {
                        
                        DB::beginTransaction();
                        
                            $request->validate([
                                'transfer_amount' => ['required', 'numeric', 'between:1,99999999999999'],
                                'transfer_wallet' => ['required'],
                                'to_user' => ['required'],
                            ]);

                            $userData = [
                                'from_user' => $UserId,
                                'transfer_amount' => $request->transfer_amount,
                                'transfer_wallet' => $request->transfer_wallet,
                                'to_user' => $request->to_user,
                            ];

                            // dd($request->transfer_wallet);
                            Transfer::create($userData);

                        
                            $balance = Balance::where('user_id', $UserId)->first();
                            $data = [
                                'balance_amount' => $balance->balance_amount - $request->transfer_amount,
                            ];
                            Balance::where('user_id', $UserId)->update($data);


                            $toUser = User::where('username', $request->to_user)->first();
                            $toUserbalance = Balance::where('user_id', $toUser->id )->first();
                            $data = [
                                'balance_amount' => $toUserbalance->balance_amount + $request->transfer_amount,
                            ];
                            Balance::where('user_id', $toUser->id)->update($data);


                            DB::commit();
                    } catch (Exception $e) {
                        // Rollback the transaction if an exception occurs.
                        DB::rollback();
                        throw $e; // Rethrow the exception after rolling back.
                        
                    }
                } else {
                    // If the total balance is not enough, redirect back with an error message.
                    return back()->with('error', $request->to_user.' is Admin');
                }
            } else {
                // If the total balance is not enough, redirect back with an error message.
                return back()->with('error', 'No E-Wallet Balance');
            }
            
        }

        return back()->with('success', 'Successfull');
    }
}
