@extends('admin.master.master',["sidebarLink"=>["main"=>'cms',"active"=>'listCms']])
@section('title')
    Content Managment
@endsection
@section('page-content-heading')
    Content Managment
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"> Content Managment List </li>
@endsection
@section('page-content')
    <div class="row" id="mainTable">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#modal-xl">
                                Add CMS
                            </button>
                            <div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4>Content Managment </h4>
                                            <button type="butto" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span class="text-danger" aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="{{ route('cms-list') }}" method="POST">

                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control {{ $errors->has('title') ? 'border border-danger' : ' ' }}"
                                                                        name="title" title="{{ $errors->first('title') }}"
                                                                        placeholder="Title">
                                                                    @if ($errors->has('title'))
                                                                        <span
                                                                            class="alert-danger">{{ $errors->first('title') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea type="text" cols="12" rows="5"
                                                                        style="resize: none"
                                                                        class="form-control {{ $errors->has('description') ? 'border border-danger' : ' ' }}"
                                                                        name="description"
                                                                        title="{{ $errors->first('description') }}"
                                                                        placeholder="description"></textarea>
                                                                    @if ($errors->has('description'))
                                                                        <span
                                                                            class="alert-danger">{{ $errors->first('description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button class="btn btn-success" style="float: right"> <i
                                                                        class="fas fa-plus-circle m-1"></i> Add
                                                                    CMS</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

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
                                <th>Description</th>
                                <th style="width: 180px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                $sr = 1;
                            @endphp
                            @foreach ($cms as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td  >
                                        <div  style="height:100px;overflow: hidden"> {{ $item->description }}</div>
                                       </td>
                                    <td>
                                        <a href="/admin/cms/update/{{ $item->id }}" class="btn btn-info">Update</a>
                                        <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#modal-{{$item->id}}-xl">
                                            view
                                        </button>
                                        <div class="modal fade" id="modal-{{$item->id}}-xl" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h4>{{$item->title}} </h4>
                                                        <button type="butto" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span class="text-danger" aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                {{$item->description}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
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
