@extends('admin.master.master',["sidebarLink"=>["main"=>'banner',"active"=>'listBanner']])
@section('title')
    Banner Preview
@endsection
@section('page-content-heading')
    Preview
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('banner-list') }}">Banner List</a></li>
    <li class="breadcrumb-item active">Preview</li>
@endsection
@section('page-content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row bg-light">
                    <div class="col-2 p-2 ">
                        <b>Caption</b>
                    </div>
                    <div class="col-10 p-2">
                        {{ $banner->caption }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 p-2">
                        <b>Image</b>
                    </div>
                    <div class="col-10 p-2">
                        <img src="{{ config('app.url') . $banner->image_url }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="row bg-light">
                    <div class="col-2 p-2 ">
                        <b>Status</b>
                    </div>
                    <div class="col-10 p-2">
                        <span class="badge  {{ $banner->status == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $banner->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="row m-2 p-2">
                    <div class="col-5 text-center p-2">
                        <a href="{{ route('banner-list') }}" class="form-control btn btn-dark">Back</a>
                    </div>
                    <div class="col-5 text-center p-2">
                        <button type="button" class="btn btn-danger form-control" data-toggle="modal"
                            data-target="#modal{{ $banner->id }}default">Delete</button>
                        <div class="modal fade" id="modal{{ $banner->id }}default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Alert !!!</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <p>Are You confirm to delete ?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="/admin/delete-banner/{{ $banner->id }}" class="btn btn-danger">Confirm
                                            Delete</a>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
