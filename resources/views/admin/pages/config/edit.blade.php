@extends('admin.master.master',["sidebarLink"=>["main"=>'config',"active"=>'listConfig']])
@section('title')
    Update Configuration
@endsection
@section('page-content-heading')
    Update Configuration
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('config-list') }}">Configuration List</a></li>
    <li class="breadcrumb-item active"> Configuration Update </li>
@endsection
@section('page-content')
    <div class="row" id="mainTable">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="{{$config->id}}">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('title') ? 'border border-danger' : ' ' }}"
                                                name="title" title="{{ $errors->first('title') }}" placeholder="Title" value="{{$config->title}}">
                                            @if ($errors->has('title'))
                                                <span class="alert-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('value') ? 'border border-danger' : ' ' }}"
                                                name="value" title="{{ $errors->first('value') }}" placeholder="value" value="{{$config->value}}">
                                            @if ($errors->has('value'))
                                                <span class="alert-danger">{{ $errors->first('value') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-success"> <i class="fas fa-plus-circle m-1"></i> update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->

                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
            </div>
        </div>
    </div>

@endsection
