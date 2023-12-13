@extends('userDashboard\page\profile\profile-layout\profile-layout')

@section('profile_content')
    <div class="container-fluid px-4">   
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>
                            <i class="fas fa-chart-area me-1"></i>
                            <span>Refarels</span>
                        </h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $refUser as $data )
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->email}}</td>

                                    @if ($data->is_verified == 1)
                                    <td class="text-success">yes</td>
                                    @else
                                    <td class="text-danger">No</td>
                                    @endif
                                    <td>{{$data->created_at}}</td>
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
