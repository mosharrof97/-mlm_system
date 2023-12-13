@extends('userDashboard\layout\layout')

@section('content')
    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h3>All Notice</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('addNotice') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title">

                            </div>

                            <div class="mb-3">
                                <label for="notice_desc" class="form-label">Description </label>
                                {{-- <input type="text" class="form-control" id="notice_desc" name="notice_desc"> --}}
                                <textarea name="notice_desc" id="notice_desc" class="form-control" cols="30" rows="10"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="notice_img" class="form-label">Image </label>
                                <input type="file" class="form-control" id="notice_img" name="notice_img">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
