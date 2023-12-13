@extends('userDashboard\page\profile\profile-layout\profile-layout')

@section('profile_content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Dashboard</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard22</li>
        </ol> --}}
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-chart-area me-1"></i>
                            <span>Your Notes</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="d-flex justify-content-center">
                            <div class="content-items">
        
                                <div class="top-author">
                                    <div class="author-items" style="border: 1px solid white">
                                        
                                            @foreach ($notices as $notice )      
                                            <div class="item">
                                                <div class="info" style="width: 100%; padding-top: 20px">
                                                    <h5 class=" text-black "> <a class="notice-title text-black "  href=" {{ url('single_notice',$notice->notice_id) }}" > {{$notice->notice_name}}</a>
                                                    </h5>
                                                    <ul class="d-flex align-items-center justify-content-between mt-4">
                                                        <li class="notice-date" style="">
                                                            <span>Published Date: </span>
                                                            <span class="mx-2">{{ $notice->created_at->format('H:i A') }}</span>
                                                            <span class="me-2">{{ $notice->created_at->format('d-m-Y') }}</span>
                                                        </li>
                                                        <li style="" class="pull-right">
                                                            <a href="{{ url('single_notice', $notice->notice_id)}} " class="btn  btn-primary ">
                                                                <i class="fas fa-plus"></i> Read More</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                           
                                            @endforeach


                                        
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            {{  $notices->links() }}
                        </div>    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
