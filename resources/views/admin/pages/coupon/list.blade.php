@extends('admin.master.master',["sidebarLink"=>["main"=>'coupon',"active"=>'listCoupon']])
@section('title')
    Coupon list
@endsection
@section('page-content-heading')
    Coupon List
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Coupon List </li>
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
                                <th style="width:200px;">Code</th>
                                <th style="width:50px;">Quantity</th>
                                <th style="width:100px;">Discount</th>
                                <th style="width:100px;">Discount Type</th>
                                <th style="width:100px;">Status</th>
                                <th style="width:100px;">Maximum Discount</th>
                                <th style="width: 300px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                if ($coupon->previousPageUrl()) {
                                    $sr = $coupon->currentPage() * $coupon->perPage() - $coupon->perPage() + 1;
                                } else {
                                    $sr = 1;
                                }
                            @endphp
                            @foreach ($coupon as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->quantity ? $item->quantity : 'Unlimited' }}</td>
                                    <td>{{ $item->discount }}</td>
                                    <td>{{ $item->percentage == 1 ? 'Percentage' : 'INR' }}</td>
                                    <td><a href="{{ route('coupon-status', $item->id) }}"
                                            class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">{{ $item->status ? 'Active' : 'Inactive' }}</a>
                                    </td>
                                    <td>{{ $item->max_disc ? $item->max_disc : 'Unlimited discount' }}</td>


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
                                                        <a href="/admin/coupon/delete/{{ $item->id }}"
                                                            class="btn btn-danger">Confirm Delete</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <a href="/admin/coupon/update/{{ $item->id }}"
                                            class="btn btn-warning">Update</a>
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
                                href="{{ $coupon->previousPageUrl() }}">&laquo;</a></li>
                        @for ($i = 1; $i <= $coupon->lastPage(); $i++)
                            <li class="page-item"><a
                                    class="page-link {{ $i == $coupon->currentPage() ? 'bg-white' : '' }}"
                                    href="/admin/category-list?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link"
                                href="{{ $coupon->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
