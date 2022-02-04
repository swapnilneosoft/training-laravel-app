@extends('admin.master.master',["sidebarLink"=>["main"=>'config',"active"=>'listConfig']])
@section('title')
     Configuration
@endsection
@section('page-content-heading')
     Configuration
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"> Configuration List </li>
@endsection
@section('page-content')
    <div class="row" id="mainTable">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <form action="{{ route('config-list') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('title') ? 'border border-danger' : ' ' }}"
                                                name="title" title="{{ $errors->first('title') }}" placeholder="Title">
                                            @if ($errors->has('title'))
                                                <span class="alert-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('value') ? 'border border-danger' : ' ' }}"
                                                name="value" title="{{ $errors->first('value') }}" placeholder="value">
                                            @if ($errors->has('value'))
                                                <span class="alert-danger">{{ $errors->first('value') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-success"> <i class="fas fa-plus-circle m-1"></i> Add
                                            Configuration</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width:300px">title</th>
                                <th>Value</th>
                                <th style="width: 180px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                $sr=1;
                            @endphp
                            @foreach ($config as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->value }}</td>
                                    <td>
                                        <a href="/admin/sub-category/update/{{ $item->id }}"
                                            class="btn btn-info">Update</a>
                                    </td>
                                </tr>
                                @php
                                    $sr++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
            </div>
        </div>
    </div>

@endsection
