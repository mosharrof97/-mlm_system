@extends('userDashboard\layout\layout')

@section('content')
<!--=============== Bannar ================-->
<div class="breadcrumb-area text-center" style="background-image: url(); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="text-white">Notice</h2>
                <ul class="breadcrumb">
                    <li><a class="text-white" href="{{url('/my-profile')}}"><i class="fas fa-home"></i> Home</a></li>
                    <li class="active" style="font-size: 16px; font-weight:600;">Notice</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--=============== Bannar ================-->

<!--========== Notice Content ============-->
<div class=" default-padding">
    <div class="container">
        <div class="row content-between align-items-center p-2" id="heading-gradiant">
            <div class="col-sm-10 text-white">
                Notice Board
            </div>
            <div class="col-sm-2 text-end">
                <a href="{{ url('/notice') }} " class="btn btn-info btn-xs"> Refresh</a>
            </div>
        </div>
        <div class="row panel-body text-justify">
            <div class="col-sm-12" style="margin-bottom: 10px;background-color: #eee;padding:10px;border-radius: 5px">
                <form action="" method="post" id="searchingForm">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" id="eventSearching" name="searchingInfoPostTitle" class="form-control" onkeyup="autoCompleteSearchingPosting(this)" placeholder="Search By Notice Title">
                            <input type="hidden" name="eventSearchingId" id="eventSearchingId">
                            <input type="hidden" id="type" name="type" value="2">
                        </div>
                        <div class="col-sm-6 ">
                            <div class="row justify-content-end">
                                <div class="col-sm-offset-1 col-sm-4">
                                    <input type="text" name="fromDate" id="fromDate" class="form-control datepicker hasDatepicker" placeholder="Search From Date">
                                </div>

                                <div class="col-sm-4">
                                    <input type="text" name="toDate" id="toDate" class="form-control datepicker hasDatepicker" placeholder="Search To Date">
                                </div>
                                <div class="col-sm-3 text-end">
                                    <button type="button" onclick="searchingEventInfo()" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <img class="loadlater" src="https://www.du.ac.bd/fontView/assets/img/loaderNew.gif" style="height: 50px;display: none">
                </div>
            </div>
            
            <div class="row">
                <div class="blog-content col-md-8" id="showInfo">
                    <div class="content-items">

                        <div class="top-author">
                            <div class="author-items" style="border: 1px solid white">
                                
                                    @foreach ($notices as $notice )      
                                    <div class="item">
                                        <div class="info" style="width: 100%; padding-top: 20px">
                                            <h5 class=" text-black "> <a class="notice-title text-black "  href=" {{ url('single-notice/',$notice->notice_id) }}" target="_blank"> {{$notice->notice_name}}</a>
                                            </h5>
                                            <ul class="content-between align-items-center">
                                                <li class="notice-date" style="">
                                                    <span>Published Date:  {{$notice->created_at}}</span>
                                                </li>
                                                <li style="" class="pull-right">
                                                    <a href="{{ url('single-notice/', $notice->notice_id)}} " target="_blank" class="btn  btn-prime ">
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

                <!-- Start Sidebar -->
                <div class="sidebar col-md-4">
                    <div class="aside">
                        <div class="sidebar-item">
                            <div class="sidebar-title">
                                <h4>Useful Links </h4>
                            </div>
                            <ul class="category">
                                <li><a href=" "><i class="fa-solid fa-angle-right"></i> Telephone and Email Index</a></li>
                                <li><a href=" " target="_blank"><i class="fa-solid fa-angle-right"></i> DU Forms</a></li>
                                <li><a href=" "><i class="fa-solid fa-angle-right"></i> Approved NOCs</a></li>
                                <li><a href=" "><i class="fa-solid fa-angle-right"></i> Trust Funds</a></li>
                                <li><a href=""><i class="fa-solid fa-angle-right"></i> Notice</a></li>
                                <li><a href=" "><i class="fa-solid fa-angle-right"></i> Latest News</a></li>
                                <li><a href=" "><i class="fa-solid fa-angle-right"></i> Events</a></li>
                                <li><a href=" "><i class="fa-solid fa-angle-right"></i>  Media</a></li>
                                <li><a href=" "><i class="fa-solid fa-angle-right"></i> Contact Us</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Start Sidebar -->
            </div>
        </div>
                
    </div>
</div>


@endsection