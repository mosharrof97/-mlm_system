@extends('userDashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Fund Transfer</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Fund Transfer</li>
        </ol> --}}
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$Balance->balance_amount}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Balance</a>

                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{($depositBalance+$ReceivedFund)-$fundTransfer}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Deposit Balance</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{($eWallet + $eWalletReceived) - $eWalletTransfer}}</div>
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
                            <div>
                                @if (Session::has('success'))
                                    <p class="text-success">{{ Session::get('success') }}</p>
                                @endif

                                @if (Session::has('error'))
                                    <p class="text-danger">{{ Session::get('error') }}</p>
                                @endif
                            </div>
                            <form class="d-flex" action="{{ route('transferred')}}" method="POST">
                                @csrf
                                <div class="me-3">
                                    <input type="text" class="form-control " name="transfer_amount" placeholder="Amount $ ">
                                    @error('transfer_amount')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div class="me-3">
                                    <select name="transfer_wallet" class="form-select me-3" id="">
                                        <option selected> Select wallet</option>
                                        <option value="e_wallet">E-Wallet</option>
                                        <option value="deposit_wallet">Deposit Wallet</option>
                                    </select>
                                    @error('transfer_wallet')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="position-relative me-3">
                                    <input type="text" class="form-control " name="to_user"  id="to_user" placeholder="To User ">
                                    <div class=" position-absulate user_list_div " >
                                        <ul role="button" id="user_list" class=" top-25 start-0 bg-light shadow w-100  ">

                                        </ul>
                                        
                                    </div>
                                    @error('to_user')
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

            <script>
                $(document).ready(function(){
                    $("#to_user").on('keyup',function(){
                        var value = $(this).val();
                        $.ajax({
                            url:"{{route('fund-transfer')}}",
                            type:"GET",
                            data:{'to_user':value},
                            success:function(data){
                                $('#user_list').html(data);
                            }
                        })
                    })
                    $(document).on('click', 'li', function(){
                        var value = $(this).text();
                        $('#to_user').val(value);
                        $('#user_list').html('');
                    })
                })
            </script>

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
                                            <td>{{$fundTransfer + $eWalletTransfer}}</td>
                                            
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

        {{--------- Received funds Table Start-----------}}
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        
                        <h4><i class="fas fa-chart-area me-1"></i>Received Fund  List</h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">From User</th>
                                    <th scope="col">Wallet Type</th>
                                    <th scope="col">Amount</th>
                                    {{-- <th scope="col">Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($FundReceivedDatas) > 0)
                                    @foreach ( $FundReceivedDatas as $data)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->from_user}}</td>
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
                                        <td>{{$ReceivedFund + $eWalletReceived}}</td>
                                        
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
          {{--------- Received funds Table END-----------}}

        
    </div>
@endsection
