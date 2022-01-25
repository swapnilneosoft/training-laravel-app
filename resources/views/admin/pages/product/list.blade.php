@extends('admin.master.master',["sidebarLink"=>["main"=>'product',"active"=>'listProduct']])
@section('title')
    Product list
@endsection
@section('page-content-heading')
    Product List
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Product List </li>
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
                                    <input type="text" id="productSearch" class="form-control"
                                        placeholder="Search by product name">
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
                                <th style="width: 10px;">#</th>
                                <th style="width:300px;">Name</th>
                                <th style="width:300px;">Description</th>
                                <th style="width:100px;">Category</th>
                                <th style="width:50px;">Quantity</th>
                                <th style="width:50px;">Price</th>
                                <th style="width: 300px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                if ($products->previousPageUrl()) {
                                    $sr = $products->currentPage() * $products->perPage() - $products->perPage() + 1;
                                } else {
                                    $sr = 1;
                                }
                            @endphp
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->getCategory->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>


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
                                                        <a href="/admin/product/delete/{{ $item->id }}"
                                                            class="btn btn-danger">Confirm Delete</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <a href="/admin/product/update/{{ $item->id }}"
                                            class="btn btn-warning">Update</a>
                                        <a href="/admin/product/preview/{{ $item->id }}"
                                            class="btn btn-info">Prview</a>
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
                                href="{{ $products->previousPageUrl() }}">&laquo;</a></li>
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item"><a
                                    class="page-link {{ $i == $products->currentPage() ? 'bg-white' : '' }}"
                                    href="/admin/category-list?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link"
                                href="{{ $products->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
