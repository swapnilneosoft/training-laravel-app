@extends('admin.master.master',["sidebarLink"=>["main"=>'category',"active"=>'listSubCategory']])
@section('title')
    Sub Category list
@endsection
@section('page-content-heading')
    Sub Category List
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Sub Category List </li>
@endsection
@section('page-content')


    <div class="row" id="mainTable">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" colspan="6">
                                            <input type="text" id="categorySearch" class="form-control"
                                                placeholder="Search user by Name or Email .....">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8 mt-2">
                            <form action="{{ route('sub-category-list') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('name') ? 'border border-danger' : ' ' }}"
                                                name="name" title="{{ $errors->first('name') }}"
                                                placeholder="Enter sub category name">
                                            @if ($errors->has('name'))
                                                <span class="alert-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select name="category_id" id="category" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($cat as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="alert-danger">{{ $errors->first('category_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-success"> <i class="fas fa-plus-circle m-1"></i> Add Sub
                                            Category</button>
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
                                <th style="width:300px">Name</th>
                                <th>Category</th>
                                <th style="width: 180px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                if ($list->previousPageUrl()) {
                                    $sr = $list->currentPage() * $list->perPage() - $list->perPage() + 1;
                                } else {
                                    $sr = 1;
                                }
                            @endphp
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->getCategory->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal{{ $item->id }}default">Delete</button>
                                        <div class="modal fade" id="modal{{ $item->id }}default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Alert !!</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <p>Are You confirm to delete ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="/admin/sub-category/delete/{{ $item->id }}"
                                                            class="btn btn-danger">Confirm Delete</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
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
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link"
                                href="{{ $list->previousPageUrl() }}">&laquo;</a></li>
                        @for ($i = 1; $i <= $list->lastPage(); $i++)
                            <li class="page-item"><a
                                    class="page-link {{ $i == $list->currentPage() ? 'bg-white' : '' }}"
                                    href="/admin/sub-category/list?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link"
                                href="{{ $list->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
