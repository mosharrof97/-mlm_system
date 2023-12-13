@extends('dashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        

        <div class="row">
            <div class="col-xl-12">
                <div class="card my-4 p-4">
                    <div class="row">
                        <div class="col-12">
                            <form class="d-flex" action="{{ route('deposit_approved', $transactions->transaction_id)}}" method="POST">
                                @csrf
                                
                               @method('PUT')
                                <div class="me-3">
                                    
                                        @if ($transactions->transaction_status ==1)
                                        <select name="transaction_status" class="form-select me-3" id="" disabled>
                                            <option value="">Select Transaction Status</option>
                                            <option value="0" {{$transactions->transaction_status == 0  ? "selected": ""}}>Not Approved</option>
                                            <option value="1"  {{$transactions->transaction_status ==1  ? "selected": ""}}>Approved</option>
                                        </select>
                                        @else
                                        <select name="transaction_status" class="form-select me-3" id="">
                                            <option value="">Select Transaction Status</option>
                                            <option value="0" {{$transactions->transaction_status == 0  ? "selected": ""}}>Not Approved</option>
                                            <option value="1"  {{$transactions->transaction_status ==1  ? "selected": ""}}>Approved</option>
                                        </select>
                                        @endif
                                        
                                   
                                    @error('transaction_status')
                                        <span id="" class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                    <input type="hidden" class="me-3" value={{$transactions->user_id}} name="user_id">
                                    <input type="hidden" class="me-3" value={{$transactions->transaction_amount}} name="transaction_amount">

                                <div class="">
                                    <input type="submit" class="btn btn-primary" value="Add Credit" >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
