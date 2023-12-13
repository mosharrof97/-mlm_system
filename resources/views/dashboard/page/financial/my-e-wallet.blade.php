@extends('dashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">My E-Wallet</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard22</li>
        </ol> --}}
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $totelBalance }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Balance</a>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{ $Refer_bonus->sum('bonus_amount') - $eWalletTransfer }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">User E-wallet</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{ $eWalletTransfer }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">E-wallet Transfer </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">{{ $Refer_bonus->sum('bonus_amount') }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Total Earned Bonus</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <div class="">
                            <i class="fas fa-chart-area me-1"></i>
                            Refarels
                        </div>
                        <div class="">
                            <a href="{{route('admin_e_wallet')}}" class="btn btn-primary">Refresh</a>
                        </div>
                        
                    </div>
                    <div class="card-body">

                {{-- search from --}}
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
                                <form class="d-flex" action="{{ route('admin_e_wallet')}}" method="get">
                                    @csrf
                                    <div class="me-3">
                                        {{-- <label for="" class="label-control ">From User</label> --}}
                                        <input type="text" class="form-control " name="username" placeholder=" From User ">
                                        @error('username')
                                            <span id="" class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                    {{-- <div class="me-3">
                                        {{-- <label for="" class="label-control ">To User </label> 
                                        <input type="text" class="form-control " name="to_user" id="to_user"  placeholder="To User ">
                                        @error('to_user')
                                            <span id="" class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
    
                                    {{-- <div class="position-relative me-3">

                                        <label for="" class="label-control ">Date </label>
                                        <input type="date d,m,y" class="form-control " name="date" placeholder="Date ">

                                         <input type="data" class="form-control " name="data"  id="data" placeholder="To User ">
                                        <div class=" position-absulate user_list_div " >
                                            <ul role="button" id="user_list" class=" top-25 start-0 bg-light shadow w-100  ">
    
                                            </ul>
                                            
                                        </div> 
                                        @error('data')
                                            <span id="" class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
    
                                    <div class="">
                                        <input type="submit" class="btn btn-primary" value="Add Credit" >
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- <script>
                            $(document).ready(function(){
                                $("#to_user").on('keyup',function(){
                                    var value = $(this).val();
                                    $.ajax({
                                        url:"{{route('admin_e_wallet')}}",
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
                        </script> --}}

{{-- search from --}}

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Refer Code</th>
                                    <th scope="col">Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->refer_code }}</td>
                                        <td>{{ $data->bonus_amount }}</td>
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
