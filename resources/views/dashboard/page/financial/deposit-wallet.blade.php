@extends('dashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Dashboard</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard22</li>
        </ol> --}}
        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $ApprovedBalance  }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Deposit Balance</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{ $pendingBalance }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Transfer Balance  </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $userTransactions->sum('transaction_amount') }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Deposit Balance</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">0</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Payout</a>
                    </div>
                </div>
            </div>

            {{-- <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">0</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Earned Bonus</a>
                    </div>
                </div>
            </div> --}}

        </div>

        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card my-4 p-4">
                    <div class="row">
                        <div class="col-12">
                            <form class="d-flex" action="{{ route('deposit')}}" method="POST">
                                @csrf
                                <div class="me-3">
                                    <input type="text" class="form-control " name="deposit" placeholder="Amount $ ">
                                    @error('deposit')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div class="me-3">
                                    <select name="deposit_method" class="form-select me-3" id="">
                                        <option value="">Select Deposit Method</option>
                                        <option value="Bkash">Bkash</option>
                                        <option value="Nagad">Nagad</option>
                                        <option value="Rocket">Rocket</option>
                                    </select>
                                    @error('deposit_method')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="me-3">
                                    <input type="text" class="form-control " name="trxid" placeholder="Transaction ID ">
                                    @error('trxid')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="">
                                    <input type="submit" class="btn btn-primary" value="Add Credit" >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Deposit Wallet
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Payment type</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">trxid</th>
                                    <th scope="col">Payment Amount</th> 
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $userTransactions as $transaction )
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$transaction->user_id}}</td> 
                                    <td>{{$transaction->transaction_type}}</td> 
                                    <td>{{$transaction->deposit_method}}</td>
                                    <td>{{$transaction->trxid}}</td>
                                    <td>{{$transaction->transaction_amount}}</td>
                                    @if ($transaction->transaction_status == 1)
                                        <td class="text-success">Approved</td>
                                    @else
                                        <td class="text-danger">Not Approved</td>
                                    @endif
                                    <td>{{$transaction->created_at}}</td>
                                    <td><a class="btn btn-primary" href="{{url('admin/deposit_approved',$transaction->transaction_id)}}">edit</a></td>
                                </tr>
                                @endforeach

                                <tr class="bg-light ">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td> {{$userTransactions->sum('transaction_amount')}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
