@extends('admin.master.master',["sidebarLink"=>["main"=>'contact',"active"=>'listContact']])
@section('title')
    Contact list
@endsection
@section('page-content-heading')
    Contact List
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Contact List </li>
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
                                <th style="width: 10px;">#</th>
                                <th style="width:200px;">Name</th>
                                <th style="width:200px;">Email</th>
                                <th style="width:100px;">Mobile</th>
                                <th style="width:300px;">Query</th>
                                <th style="width:50px;">Status</th>
                                <th style="width: 50px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                if ($contact->previousPageUrl()) {
                                    $sr = $contact->currentPage() * $contact->perPage() - $contact->perPage() + 1;
                                } else {
                                    $sr = 1;
                                }
                            @endphp
                            @foreach ($contact as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->query }}</td>
                                    <td><a href="{{ route('contact-status', $item->id) }}"
                                            class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">{{ $item->status ? 'Active' : 'Inactive' }}</a>
                                    </td>

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
                                                        <a href="/admin/contact/delete/{{ $item->id }}"
                                                            class="btn btn-danger">Confirm Delete</a>
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
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link"
                                href="{{ $contact->previousPageUrl() }}">&laquo;</a></li>
                        @for ($i = 1; $i <= $contact->lastPage(); $i++)
                            <li class="page-item"><a
                                    class="page-link {{ $i == $contact->currentPage() ? 'bg-white' : '' }}"
                                    href="/admin/contact/list?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link"
                                href="{{ $contact->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
