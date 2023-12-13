@extends('userDashboard\page\profile\profile-layout\profile-layout')

@section('profile_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">My Profile</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        
        <div class="row">
            <div class="col-xl-4">
                <div class="card shadow mb-4" >
                    <table class="table table-hover table-borderless">
                        <thead >
                            <tr>
                                <th scope="col">About Us</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2"></i>
                                    <Span>{{$user->name}}</Span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2"></i>
                                    <Span>{{ $user->email }}</Span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2"></i>
                                    <Span>Create : {{ $user->created_at }}</Span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2"></i>
                                    <Span>Update : {{ $user->updated_at }}</Span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="card shadow mb-4">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Sponsor Information</th>
                            </tr>
                        </thead>

                       
                        <tbody>
                            @if($user->refer_id > 0)
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2"></i>
                                    <Span>{{ $refUser->name }}</Span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2"></i>
                                    <Span>{{ $user->refer_code }}</Span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user me-2"></i>
                                    <Span>Create : {{ $refUser->created_at}}</Span>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>
                                    <h4>No Sponsor</h4>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>

            </div>
            <div class="col-xl-8">
                <div class="card mb-4 p-2">
                    <div class="row ">
                        <div class="col-xl-6 col-md-9">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body ">0</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Personal Sales BV</a>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-9">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">0</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Team Sales BV</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-9">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">{{$count}}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">referrals</a>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-9">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">{{$Balance->balance_amount}}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">Balance</a>
                                </div>
                            </div>
                        </div>                       
                        
                    </div>
                </div>

                {{-- Blog Area --}}
                <div class=" p-2">
                    <div class="">
                       <div class="card shadow py-4 px-5">
                           <div class="d-flex align-items-center">
                               
                               <div class="me-3">
                                   <img src="{{ asset('upload/BlogImage/'.Auth::user()->image) }}" alt="" width="55" height="50" class="rounded-circle">
                               </div>
                           
                               <div class="bg-body-secondary form-control" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                   <span>What's on your mind, {{ Auth::user()->name }}?</span>
                               </div>
                           
                           </div>
                       </div>
                   </div>

                   <!-- Modal -->
                   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                       tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header border-bottom border-light">
                                   <div class="">
                                       <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Create Blog post</h1>
                                   </div>

                                   <div class="">
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close" ></button>
                                   </div>
                               </div>

                               <div class="modal-body">
                                   <div class="d-flex my-3 position-relative">
                                       <img src="{{ asset('upload/BlogImage/'.Auth::user()->image) }}" alt="" width="50" height="50" class="rounded-circle me-3">
                                       <h5> {{ Auth::user()->name }}</h5>

                                   </div>

                                   <form action="{{url('add-blogs')}}" method="post" enctype="multipart/form-data">
                                       @csrf
                                       <div class="mb-3">
                                           <select name="blog_condition" id="" class="border-0 position-absolute " style="top: 20%; left: 16% !important;">
                                               <option value="Public">Public</option>
                                               <option value="Refer">Refer</option>
                                               <option value="Private">Private</option>
                                           </select>
                                       </div>
                                       <div class="mb-3">
                                           <textarea class="form-control  border-0" name="blog_desc" id="" cols="30" rows="3"  placeholder="What's on your mind ?"></textarea>
                                       </div>
                                       <div class="mb-3">
                                           <input type="file" name="blog_img" id="" class="form-control">
                                       </div>
                                       <div class="text-end mb-3 ">
                                           <button class="btn btn-primary form-control">Submit</button>
                                       </div>
                                   </form>
                               </div>
                               {{-- <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                   <button type="button" class="btn btn-primary">Understood</button> 
                               </div> --}}
                           </div>
                       </div>
                   </div>

                   <div class="my-3">
                      
                           @foreach ($blog as $data )
                               <div class="card">

                                   <div class="card-body">
                                       <div class="d-flex">
                                        @if ($data->image !== null)
                                        <img src="{{ asset('upload/BlogImage/'.$data->image) }}" alt="" width="50" height="50" class="rounded-circle me-3">
                                        @else
                                        
                                           <img src=" https://static.vecteezy.com/system/resources/previews/020/765/399/non_2x/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg" alt="" width="50" height="50" class="rounded-circle me-3" style="border: 2px solid black;  ">
                                       
                                        
                                        @endif
                                           
                                           <div class="">
                                               <h5> {{ $data->name }}</h5>
                                               <span class="mx-2">{{ $data->created_at->format('H:i A') }}</span>
                                               <span class="me-2">{{ $data->created_at->format('d-m-Y') }}</span>
                                               <span class="mx-2">{{ $data->blog_condition}}</span>
                                           </div>
                                       </div>
                                       
                                       <div class="mt-4">
                                           <div class="me-2">
                                               <p>{{$data->blog_desc}}</p>
                                           </div>
                                           @if ($data->blog_img != null)
                                               <div class="my-2">
                                                   <img class="vh-20" src="{{asset('upload/BlogImage/'.$data->blog_img)}}" alt="Notice Image">
                                                   {{-- <img class="vh-25" src="storage/apppublic\BlogImage{{$data->blog_img}}" alt="Notice Image"> --}}
                                               </div>
                                           @endif
                                           
                                           
                                       </div>
                                   
                                       <div class="d-flex justify-content-between align-items-center py-2">
                                           <div class="">Like</div>
                                           <div class=""> comment</div>
                                           <div class="">Share</div>
                                       </div>
                                   </div>

                               </div>
                           @endforeach
                   </div>

               </div>
               
            </div>
        </div>
    </div>
@endsection
