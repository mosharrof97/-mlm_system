@extends('userDashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Network</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Network</li>
        </ol> --}}
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $totelBalance->balance_amount }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Balance</a>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">0</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Team Sales BV</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">{{$eWallet}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Network Bonus</a>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">{{ $eWallet }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Referral Bonus</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Refarels
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $refer_user as $data)
                                <tr>
                                    <th scope="col">{{ $loop->iteration }}</th>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->email}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Refer Progress
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Refer Code</th>
                                    <th scope="col">Referrals</th>
                                    <th scope="col">Email</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach( $secondRefer as $data)
                                <tr>
                                    <th scope="col">{{ $loop->iteration }}</th>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->refer_code}}</td>
                                    <td>{{count($data->refer_code)}}</td>
                                    <td>{{$data->email}}</td>
                                </tr>
                                @endforeach --}}
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
