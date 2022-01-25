@extends('admin.master.master',["sidebarLink"=>["main"=>'banner',"active"=>'editBanner']])
@section('title')
    Update User
@endsection
@section('page-content-heading')
    Edit Banner
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Banner List</a></li>
    <li class="breadcrumb-item active">Edit Banner </li>
@endsection
@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image">Select Image</label>
                            <input type="file" class="form-control" onchange="loadFile(event)" name="image" id="inptImg">
                            @if ($errors->has('image'))
                                <div class="alert alert-danger ml-4 mr-4 mt-1 ">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <textarea name="caption" id="" cols="10" rows="3" class="form-control"
                                style="resize: none">{{ $banner->caption }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3 col-form-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1" name="status"
                                            checked value="1">
                                        <label for="customRadio1" class="custom-control-label">Active</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2" name="status"
                                            value="0" {{ $banner->status == 0 ? 'checked' : '' }}>
                                        <label for="customRadio2" class="custom-control-label">Inactive</label>
                                    </div>
                                </div>

                                @if ($errors->has('status'))
                                    <div class="col-12 text-danger text-center alert-box">{{ $errors->first('status') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <img src="{{ config('app.url') . $banner->image_url }}" alt="" class="img-fluid"
                                id="frameImg" width="50%">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success" style="width: 70%">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('frameImg');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection
