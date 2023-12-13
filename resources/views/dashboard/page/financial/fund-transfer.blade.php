@extends('dashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Fund Transfer</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Fund Transfer</li>
        </ol> --}}
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$Balance}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Balance</a>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{$depositBalance}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Deposit Balance</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$eWallet->sum('bonus_amount') }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">E-Wallet Balance</a>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$FundTransferDatas->sum('transfer_amount') }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">E-Wallet Balance</a>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-12">
                <div class="card my-4 p-4">
                    <div class="row">
                        <div class="col-12">
                            
                            <form class="d-flex" action="{{ route('admin_view_transfer')}}" method="get">
                                @csrf
                                <div class="me-3">
                                    <input type="text" class="form-control " name="from_user" placeholder="Form User ">
                                </div>

                                <div class="me-3">
                                    <input type="text" class="form-control " name="to_user" placeholder="To User ">
                                </div>

                                <div class="">
                                    <input type="submit" class="btn btn-primary" value="Search" >
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
                                    <th scope="col">From User</th>
                                    <th scope="col">To User</th>
                                    <th scope="col">Wallet Type</th>
                                    <th scope="col">Amount</th>
                                    {{-- <th scope="col">Transfer Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($FundTransferDatas) > 0)
                                    @foreach ( $FundTransferDatas  as $data )
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->username}}</td>
                                            <td>{{$data->to_user}}</td>
                                            <td> {{$data->transfer_wallet}}</td>
                                            <td>${{$data->transfer_amount}}</td>
                                            
                                            {{-- @if ($data->transfer_status == 0 )
                                                <td class="text-primary h6"> Pending</td>
                                            @elseif ($data->transfer_status == 1)
                                                <td class="text-success h6"> Completed</td>
                                            @else
                                                <td class="text-danger h6"> Cancelled</td>
                                            @endif --}}
                                            
                                        </tr>
                                    @endforeach
                                        <tr>
                                            
                                            <td colspan="3"></td>
                                            <td colspan="">total</td>
                                            <td>{{$FundTransferDatas->sum('transfer_amount') }}</td>
                                            
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
