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
                        <span>View Notice</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h3>{{$notice->notice_name}}</h3>
                        </div>
                        <div class="my-3">
                            <span class="me-2">{{ $notice->created_at->format('H:i A') }}</span>
                            <span class="me-2">{{ $notice->created_at->format('d-m-Y') }}</span>
                            {{-- <p>{{ $notice->created_at->format('Y-m-d\H:i:s') }}</p> --}}
                        </div>

                        <figure class="figure">
                            {{-- @if ($notice->notice_img > 0)                          --}}
                            <div class="my-3">
                                <img class="figure-img img-fluid rounded"  src="{{ asset('upload/noticeImage/' . $notice->notice_img )}}" alt="Notice Image">
                            </div>                            
                            {{-- @endif --}}
                            
                            <div class="my-3">
                                <figcaption class="figure-caption">{{$notice->notice_desc}}</figcaption>
                            </div>
                        </figure>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection