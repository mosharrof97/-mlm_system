@extends('userDashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Withdraw</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Fund Transfer</li>
        </ol> --}}
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$balance->balance_amount}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Balance</a>

                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{ $totalDeposit }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Deposit Balance</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$eWallet}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">E-Wallet Balance</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $withdrawBalance }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Withdraw Balance</a>

                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{ $pendingWithdraw }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Withdraw Pending Balance</a>
                    </div>
                </div>
            </div>
            
        </div>



        <div class="row">
            <div class="col-xl-12">
                <div class="card my-4 p-4">
                    <div class="row">
                        <div class="col-6">
                            <div>
                                @if (Session::has('success'))
                                    <p class="text-success">{{ Session::get('success') }}</p>
                                @endif

                                @if (Session::has('error'))
                                    <p class="text-danger">{{ Session::get('error') }}</p>
                                @endif
                            </div>                           
                            <form class="" action="{{ route('withdraw_amount')}}" method="POST">
                                @csrf
                                
                                <div class="mt-3">
                                    <input type="text" class="form-control " name="amount" placeholder="amount $0.00 ">
                                    @error('amount')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <select name="wallet" class="form-select" id="">
                                        <option value="">Select wallet Type</option>
                                        <option value="deposit wallet">deposit wallet</option>
                                        <option value="E-wallet">E-wallet</option>
                                    </select>

                                    @error('method')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <input type="text" class="form-control " name="account" placeholder="Form User ">
                                    @error('account')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <select name="method" class="form-select" id="">
                                        <option value="">Select withdraw method</option>
                                        <option value="Bkash">Bkash</option>
                                        <option value="Nagad">Nagad</option>
                                        <option value="Rocket">Rocket</option>
                                    </select>

                                    @error('method')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <input type="submit" class="btn btn-primary" value="Withdraw" >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{---------  Fund Transfer Table Start-----------}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        
                        <h4><i class="fas fa-chart-area me-1"></i>Transfer Fund  List</h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Wallet Type</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Account</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Transfer Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($withdraw) > 0)
                                    @foreach ( $withdraw  as $data )
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->username}}</td>
                                            <td>{{$data->withdraw_type}}</td>
                                            <td>{{$data->withdraw_method}}</td>
                                            <td>{{$data->withdraw_account}}</td>
                                            <td>${{$data->withdraw_amount}}</td>
                                            
                                             @if ($data->withdraw_status == 0 )
                                                <td class="text-primary h6"> Pending</td>
                                            @elseif ($data->withdraw_status == 1)
                                                <td class="text-success h6"> Completed</td>
                                            @elseif ($data->withdraw_status == 2)
                                                <td class="text-danger h6"> Cancelled</td>
                                            @endif 
                                            
                                        </tr>
                                    @endforeach
                                        <tr>
                                            
                                            <td colspan="3"></td>
                                            <td colspan="">total</td>
                                            <td>{{$withdraw->sum('withdraw_amount') }}</td>
                                            
                                        </tr>
                                @else
                                    <tr>
                                        <td colspan="5"><h3 class="text-center">Data Not Found</h3> </td>  
                                    </tr>
                                 @endif

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
        {{---------  Fund Transfer Table END-----------}}

      
        
    </div>
@endsection
