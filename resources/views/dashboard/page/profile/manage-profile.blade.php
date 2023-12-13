@extends('dashboard\page\profile\profile-layout\profile-layout')
@section('profile_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">My Profile</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="row justify-content-center">
                        <div class=" col-12 edit-profile-pic"  data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                            @if (Auth::user()->image != null)
                                     <img class="" src="{{asset('upload/BlogImage/'.Auth::user()->image)}}" alt=" Image">
                                                  
                            @else
                            <img src="https://static.vecteezy.com/system/resources/previews/020/765/399/non_2x/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg"
                            alt="" width="" height="">
                            @endif
                        </div>

                        {{-- <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                                    Launch demo modal
                                </button> --}}

                            {{-- <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Profile Image</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{ route('admin_profile.update') }}"  method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="mt-3">
                                                    <input type="file" class="form-control" name="image" id="" value="{{old('image', Auth::user()->image)}}">
                                                </div>

                                                 <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button> 
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card mb-4">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('dashboard.page.profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('dashboard.page.profile.partials.update-password-form')
                        </div>
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('dashboard.page.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
