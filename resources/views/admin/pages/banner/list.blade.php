@extends('admin.master.master',["sidebarLink"=>["main"=>'banner',"active"=>'listBanner']])
@section('title')
    Banner list
@endsection
@section('page-content-heading')
    List
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Banner List</li>
@endsection
@section('page-content')

    <div class="row" id="mainTable">
        <div class="col">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width:100px">Image</th>
                                <th style="width:300px">Caption</th>
                                <th style="width:50px">Status</th>
                                <th style="width: 180px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                if ($banners->previousPageUrl()) {
                                    $sr = $banners->currentPage() * $banners->perPage() - $banners->perPage() + 1;
                                } else {
                                    $sr = 1;
                                }
                            @endphp
                            @foreach ($banners as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>
                                        <img src="{{ config('app.url') . $item->image_url }}" alt="" class="img-fluid"
                                            width="70%">
                                    </td>
                                    <td>
                                        {{ $item->caption }}
                                    </td>
                                    <td>
                                        <a href="/admin/status-banner/{{ $item->id }}"
                                            class="badge  {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal{{ $item->id }}default">Delete</button>
                                        <div class="modal fade" id="modal{{ $item->id }}default">
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
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="/admin/delete-banner/{{ $item->id }}"
                                                            class="btn btn-danger">Confirm Delete</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <a href="/admin/update-banner/{{ $item->id }}"
                                            class="btn btn-info">Update</a>
                                        <a href="/admin/banner-image/preview/{{ $item->id }}"
                                            class="btn btn-dark">Preview</a>
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
                                href="{{ $banners->previousPageUrl() }}">&laquo;</a></li>
                        @for ($i = 1; $i <= $banners->lastPage(); $i++)
                            <li class="page-item"><a
                                    class="page-link {{ $i == $banners->currentPage() ? 'bg-white' : '' }}"
                                    href="/admin/banner-list?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link"
                                href="{{ $banners->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
