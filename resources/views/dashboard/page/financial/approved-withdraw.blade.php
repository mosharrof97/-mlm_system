@extends('dashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        

        <div class="row">
            <div class="col-xl-12">
                <div class="card my-4 p-4">
                    <div class="row">
                        <div class="col-12">
                            <form class="d-flex" action="{{ route('Approvewithdraw', $withdraw->withdraw_id)}}" method="POST">
                                @csrf
                                
                               @method('PUT')
                                <div class="me-3">
                                    
                                        @if ($withdraw->withdraw_status ==1)
                                        <select name="withdraw_status" class="form-select me-3" id="" disabled>
                                            <option value="1"  {{$withdraw->withdraw_status ==1  ? "selected": ""}}>Approved</option>
                                        </select>
                                        @elseif ($withdraw->withdraw_status ==2)
                                        <select name="withdraw_status" class="form-select me-3" id="" disabled>
                                            <option value="2"  {{$withdraw->withdraw_status ==2 ? "selected": ""}}>Cancelled</option>
                                        </select>
                                        @else
                                        <select name="withdraw_status" class="form-select me-3" id="" >
                                            <option value="">Select Transaction Status</option>

                                            <option value="0" {{$withdraw->withdraw_status == 0  ? "selected": ""}}>Pending</option>

                                            <option value="1"  {{$withdraw->withdraw_status ==1  ? "selected": ""}}>Approved</option>

                                            <option value="2"  {{$withdraw->withdraw_status ==2 ? "selected": ""}}>Cancelled</option>
                                        </select>
                                        @endif
                                        
                                   
                                    @error('withdraw_status')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                    <input type="text" class=" me-3" value={{$withdraw->user_id}} name="user_id">
                                    <input type="text" class=" me-3" value={{$withdraw->withdraw_amount}} name="withdraw_amount">

                                <div class="">
                                    <input type="submit" class="btn btn-primary" value="Approved " >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
