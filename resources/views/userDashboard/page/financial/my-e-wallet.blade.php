@extends('userDashboard\layout\layout')

@section('content')
    <div class="container-fluid px-1">
        <h1 class="my-4">My E-Wallet</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard22</li>
        </ol> --}}
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$totelBalance->balance_amount}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Balance</a>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{( $eWallet + $Received_E_wallet ) - $transfer_E_wallet }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">My E-wallet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{$transfer_E_wallet}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">E-wallet Transfer </a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">{{$eWallet}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Earned Bonus</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-7">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Refarels
                    </div>
                    <div class="card-body p-2">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    {{-- <th scope="col">Name</th> --}}
                                    <th scope="col">User name</th>
                                    <th scope="col">Refarel id</th>
                                    <th scope="col">Email</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $refer_userData as $data )
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$data->created_at}}</td>
                                    {{-- <td>{{$data->user->name}}</td> --}}
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->referral_code}}</td>
                                    <td>{{$data->email}}</td>
                                </tr>
                                @endforeach
                                
                                
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Received E-Wallet
                    </div>
                    <div class="card-body p-2">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    {{-- <th scope="col">Name</th> --}}
                                    <th scope="col">From User</th>
                                    <th scope="col">Amount</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $userData as $data )
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$data->created_at}}</td>
                                    {{-- <td>{{$data->user->name}}</td> --}}
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->transfer_amount}}</td>
                                </tr>
                                @endforeach
                                
                                
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
