@extends('userDashboard\page\profile\profile-layout\profile-layout')

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
                        <div class=" col-12 edit-profile-pic">
                            @if (Auth::user()->image !== null)
                                <img src="{{ asset('upload/BlogImage/'.Auth::user()->image) }}"
                                alt="" width="" height="">
                            @else
                                <img src="https://static.vecteezy.com/system/resources/previews/020/765/399/non_2x/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg"
                                alt="" width="" height="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card mb-4">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('userDashboard.page.profile.partials.update-profile-information-form')
                            </div>
                    </div>
                </div>


                    <div class="card mb-4">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('userDashboard.page.profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('userDashboard.page.profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
