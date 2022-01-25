@extends('admin.master.master',["sidebarLink"=>["main"=>'order',"active"=>'pending']])
@section('title')
    Pending orders list
@endsection
@section('page-content-heading')
   Pending Order List
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Pending Order List </li>
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
                                <th style="width:100px">id</th>
                                <th>amount</th>
                                <th>payment mode</th>
                                <th>payment status</th>
                                <th>order status</th>
                                <th style="width: 180px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            @php
                                if ($orders->previousPageUrl()) {
                                    $sr = $orders->currentPage() * $orders->perPage() - $orders->perPage() + 1;
                                } else {
                                    $sr = 1;
                                }
                            @endphp
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->payment_mode == 0 ? 'Cash On Delivery' : 'Online'   }}</td>
                                    <td>{{ $item->payment_status == 1 ? 'Paid' : 'Unpaid'  }}</td>
                                    <td>{{ $item->status == 0 ? 'Processing' : ($item->status == 1 ? 'Dispatched' : 'Delivered') }}</td>


                                    <td>
                                        <a href="/admin/order/preview/{{ $item->id }}"
                                            class="btn btn-info">preview</a>
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
                                href="{{ $orders->previousPageUrl() }}">&laquo;</a></li>
                        @for ($i = 1; $i <= $orders->lastPage(); $i++)
                            <li class="page-item"><a
                                    class="page-link {{ $i == $orders->currentPage() ? 'bg-white' : '' }}"
                                    href="/admin/order/pending-orders?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link"
                                href="{{ $orders->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
