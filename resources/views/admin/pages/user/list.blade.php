@extends('admin.master.master',["sidebarLink"=>["main"=>'user',"active"=>'list']])
@section('title')
    User List
@endsection
@section('page-content-heading')
    User List
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">User list</li>
@endsection

@section('page-content')

    <div class="row" id="mainTable">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px" colspan="6">
                                    <input type="text" id="userSearch" class="form-control"
                                        placeholder="Search user by Name or Email .....">
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width:300px">Name</th>
                                <th>Email</th>
                                <th style="width:50px">Status</th>
                                <th style="width: 40px">Role</th>
                                <th style="width: 180px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                if ($users->previousPageUrl()) {
                                    $sr = $users->currentPage() * $users->perPage() - $users->perPage() + 1;
                                } else {
                                    $sr = 1;
                                }
                            @endphp
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->firstname . ' ' . $item->lastname }}</td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        <a href="/admin/status-user/{{ $item->id }}"
                                            class="badge  {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $item->getRole->name }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal{{ $item->id }}default">Delete</button>
                                        <div class="modal fade" id="modal{{ $item->id }}default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Default Modal</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-danger">If you are going to delete yourself then
                                                            you will loose all data !!!</p>
                                                        <p>Are You confirm to delete ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="/admin/delete-user/{{ $item->id }}"
                                                            class="btn btn-danger">Confirm Delete</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <a href="/admin/update-user/{{ $item->id }}" class="btn btn-info">Update</a>
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
                                href="{{ $users->previousPageUrl() }}">&laquo;</a></li>
                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="page-item"><a
                                    class="page-link {{ $i == $users->currentPage() ? 'bg-white' : '' }}"
                                    href="/admin/user-list?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link"
                                href="{{ $users->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
