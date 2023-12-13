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
use App\Models\Withdraw;
use DB;

class AdminWithdrawController extends Controller
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
       
        $this->Balance = Balance::get();

        // $this->transactions = Transaction::join('users','users.id','=','transactions.user_id')->paginate(20);
        // $this->deposit = $this->transactions ->where('transaction_status', 1)->sum('transaction_amount');   
        // $this->bonus = Refer_bonus::get()->sum('bonus_amount');

        // // $this->depositTransfer = Transfer::where("transfer_wallet", "deposit_wallet")-> get()->sum('transfer_amount');
        // // $this->eWalletTransfer = Transfer::where("transfer_wallet", "e_wallet")-> get()->sum('transfer_amount');
      
        
        $this->withdraw = Withdraw::join('users','users.id','=','withdraws.user_id')->orderBy('withdraw_id', 'desc')->groupBy()->paginate(20);
        $this->withdrawBalance = $this->withdraw ->where('withdraw_status', 1)->sum('withdraw_amount');   
        $this->pendingWithdraw = $this->withdraw ->where('withdraw_status', 0)->sum('withdraw_amount');   

        // $this->depositBalance  = $this->deposit - $this->withdrawBalance ;
        // $this->Wallet= $this->bonus  -  $this->withdrawBalance;
        
    }
    public function Withdraw(){
        $this->initializeData();
        return view('dashboard.page.financial.withdraw ', 
        [
            'Balance'=>$this->Balance,
            'withdraw'=> $this->withdraw,
            'withdrawBalance'=> $this->withdrawBalance ,
            'pendingWithdraw'=>$this->pendingWithdraw,
        ]);
    }


    // public function Withdraw_amount(Request $request){
    //     $request->validate([
    //         'amount' => ['required', 'numeric', 'between:1,99999999999999'],
    //         'method' => ['required'],
    //         'account' => ['required'],
    //     ]);

    //     if($request->wallet == 'deposit wallet'){
    //         // if($this->depositBalance ){
    //             $userData = [
    //                 'user_id' => Auth::User()->id,
    //                 'withdraw_amount' => $request->amount,
    //                 'withdraw_type' => $request->wallet,
    //                 'withdraw_method' => $request->method,
    //                 'withdraw_account' => $request->account,
    //             ];
               
    //             Withdraw::create($userData);
        
    //             return back()->with('success', 'Withdraw Sussessfull!');
    //         // }else{
                
    //         //     return back()->with('error', 'No Deposit Balance');
    //         // }
    //     // }elseif ($request->wallet == 'E-wallet') {
    //     //     if($this->depositBalance > 100){
    //     //         $userData = [
    //     //             'user_id' => Auth::User()->id,
    //     //             'withdraw_amount' => $request->amount,
    //     //             'withdraw_type' => $request->wallet,
    //     //             'withdraw_method' => $request->method,
    //     //             'withdraw_account' => $request->account,
    //     //         ];
    //     //         dd($userData);
    //     //         Withdraw::create($userData);
        
    //     //         return back()->with('success', 'Withdraw Sussessfull!');
    //     //     }else{
                
    //     //         return back()->with('error', 'No Deposit Balance');
    //     //     }
    //     } else {
    //         return back()->with('error', 'Please select deposit wallet');
    //     }
        
        
        
    // }
    public function edit($id)
    {
        $withdraw = Withdraw::where('withdraw_id', $id)->first();
        //    dd( $transactions);
        return view('dashboard.page.financial.approved-withdraw', compact(['withdraw']));
    }

    public function ApproveWithdraw(Request $request,  $id)
    {
        // dd($request);
        $withdraw = Withdraw::where('withdraw_id', $id)->first();
        if ($withdraw->withdraw_status == 1 || $withdraw->withdraw_status == 2) {
            return redirect(Route('admin-withdraw'));
        } else {
            $request->validate([
                'withdraw_status' => ['required'],
            ]);

            DB::beginTransaction();
            try {
                $userData = [
                    'withdraw_status' => $request->withdraw_status,
                ];

                // dd($userData);
                Withdraw::where('withdraw_id', $id)->update($userData);

                
                if ($request->withdraw_status == 1) {
                    $rak = Balance::where('user_id', $request->user_id)->first();
                    $data = [
                        // 'user_id' => $request->user_id,
                        'balance_amount' =>$rak->balance_amount - $request->withdraw_amount,
                    ];
                    // dd($data);
                    Balance::where('user_id', $request->user_id)->update($data);
                }
                
                DB::commit();
                return redirect(Route('admin-withdraw'));

            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }
}
