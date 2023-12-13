@extends('dashboard\layout\layout')

@section('content')
    <div class="container-fluid px-2">
        <h1 class="my-4">User Profile</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Fund Transfer</li>
        </ol> --}}
        <div class="row">
            <div class="col-12">
                <div class="card-header">
                    <div class="">
                        <div class="">
                            <img src="https://res.cloudinary.com/omaha-code/image/upload/ar_4:3,c_fill,dpr_1.0,e_art:quartz,g_auto,h_396,q_auto:best,t_Linkedin_official,w_1584/v1561576558/mountains-1412683_1280.png"
                                class="card-img-top" alt="...">
                        </div>
                        <div class="row  profile-pic-name">
                            <div class="col-4">
                                <div class="d-flex align-items-end">
                                    <div class=" profile-pic">
                                      @if (Auth::user()->image !== null)
                                      <img src="{{ asset('upload/BlogImage/'.Auth::user()->image) }}" alt="Mosharrof" width="" height=""
                                      class="rounded-circle">
                                  @else
                                      <img src="https://static.vecteezy.com/system/resources/previews/020/765/399/non_2x/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg" alt="Mosharrof" width="" height=""
                                      class="rounded-circle" >
                                  @endif
                                    </div>
                                    <div class="profile-name">
                                        <h5>{{ Auth::user()->name }}</h5>
                                        <p>{{'@'.Auth::user()->username }}</p>
                                        <p>Ref: {{ Auth::user()->referral_code }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                              <nav class="navbar navbar-expand-lg bg-body-tertiary">
                                <div class="container-fluid">
                                  
                                  <div class="collapse navbar-collapse justify-content-center" >
                                    <div class="navbar-nav">
                                      <a class="nav-link  mx-1 active" aria-current="page" href="{{ url('admin/blogs')}}">
                                        <i class="fa-solid fa-user me-1"></i>
                                        <span> Blogs</span>
                                      </a>
                                      <a class="nav-link  mx-1 active" aria-current="page" href="{{ route('admin_profile') }}">
                                        <i class="fa-solid fa-user me-1"></i>
                                        <span> My Profile</span>
                                      </a>
                                      <a class="nav-link mx-1" href="{{ route('admin_profile.edit')}}">
                                        <i class="fa-regular fa-pen-to-square me-1"></i>
                                        <span>Edit Info</span> 
                                      </a>
                                      <a class="nav-link mx-1" href="#">
                                        <i class="fa-solid fa-gear me-1"></i>
                                        <span>Settings</span> 
                                      </a>
                                      
                                      <a class="nav-link mx-1" href="{{ url('admin/referrals-list')}}">
                                        <i class="fa-solid fa-tower-broadcast me-1"></i>
                                        <span>Referrals</span> 
                                      </a>
    
                                      <a class="nav-link mx-1" href="{{ url('admin/notice')}}">
                                        <i class="fa-regular fa-bell me-1"></i>
                                        <span>Notice</span> 
                                      </a>
                                      
                                  </div>
                                </div>
                              </nav>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        {{-- content Area --}}
                        
                        <div class="container-fluid">
                            {{-- --  Row 1 --}}

                            @yield('profile_content')


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
