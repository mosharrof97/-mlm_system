<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\user_dashboard.style.css') }}">
    <title>Document</title>
</head>

<body class="bg-light">

    <div class="container-fluid">

        <div class="row justify-content-center my-5">
            <div class="col-11 ">

                <div class="row justify-content-center ">
                    <div class="col-5  p-3 d-none  d-lg-block" style="background-color: white;">
                        <div class="py-3">
                            <img src="" alt="logo">
                        </div>
                        <div class="my-5">
                            <h2> Register New Member Cloud MLM </h2>
                        </div>

                        <div class="user-auth-img">
                            <img src="{{ asset('assets\img\login.335d9a0c8f4d38c0af48.webp') }}" alt="">
                        </div>

                    </div> 
                    <div class="col-7">
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <div class=" ">
                                    <p class=" text-end">Already have an account ?   <a  href="nav-link">Login</a></p>
                                </div>

                                <div>
                                    @if (Session::has('success'))
                                        <p class="text-success">{{ Session::get('success') }}</p>
                                    @endif

                                    @if (Session::has('error'))
                                        <p class="text-danger">{{ Session::get('error') }}</p>
                                    @endif
                                </div>

                                <form action="{{ route('add_role') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Roll Name</label>
                                        <input type="text" class="form-control" id="name" name="name">

                                        @error('name')
                                            <span id="" class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
