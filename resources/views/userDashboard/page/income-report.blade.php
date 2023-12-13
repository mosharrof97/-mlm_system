@extends('userDashboard\layout\layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Dashboard</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard22</li>
        </ol> --}}
        <div class="row">
            <div class="">
                <div class="my-4">
                    <form action="" mathod="POST" class="d-flex p-4 shadow" >
                        <input type="date" class="form-control me-3" name="income_search">
                        <input type="date" class="form-control me-3" name="income_search">
                        <select name="" id="" class="form-control me-3" >
                            <option value="All" selected>All</option>
                            <option value="Referral_Bonus">Referral Bonus</option>
                            <option value="Binary_Bonus">Binary Bonus</option>
                            <option value="First_Order_Bonus">First Order Bonus</option>
                            <option value="Achievement_Bonus">Achievement Bonus</option>
                            <option value="Credited_By_Admin">Credited By Admin</option>
                        </select>
                        <input type="submit" class="form-control btn btn-primary" value="Get Report">
                    </form>
                </div>
            </div>
            
            
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Refarels
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">From User</th>
                                    <th scope="col">Amount type</th>
                                    <th scope="col">Credit($)</th>
                                    <th scope="col">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>mlmadmin</td>
                                    <td>Fund Transfer</td>
                                    <td>100.0</td>
                                    <td>05/10/2023</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>mlmadmin</td>
                                    <td>Fund Transfer</td>
                                    <td>130.0</td>
                                    <td>05/10/2023</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>mlmadmin</td>
                                    <td>Fund Transfer</td>
                                    <td>102.0</td>
                                    <td>05/10/2023</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>sdfgcvd</td>
                                    <td>Fund Transfer</td>
                                    <td>100.0</td>
                                    <td>05/10/2023</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>mskasfsd</td>
                                    <td>Fund Transfer</td>
                                    <td>120.0</td>
                                    <td>05/10/2023</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Arjun</td>
                                    <td>Fund Transfer</td>
                                    <td>110.0</td>
                                    <td>05/10/2023</td>
                                </tr>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
