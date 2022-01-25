@extends('admin.master.master',["sidebarLink"=>["main"=>'order',"active"=>'all']])
@section('title')
    Order preview
@endsection
@section('page-content-heading')
    Order preview
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('all-order-list') }}">Order List</a></li>
    <li class="breadcrumb-item active">Order preview </li>
@endsection
@section('page-content')

    <div class="container">
        <div class="row card">
            <div class="card-body">

                <div class="col-md-12">
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2 ">Id</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $order->id }}</div>
                    </div>
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2 ">Amount</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $order->amount }}</div>
                    </div>
                    <div class="row m-1 p-2">
                        <div class="col-2 ">Product Quantity</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ count($order->getProducts) }}</div>
                    </div>
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2">Payment Status</div>
                        <div class="col-1">:</div>
                        <div class="col-9">{{ $order->payment_status == 0 ? 'Unpaid' : 'Paid' }}</div>
                    </div>
                    <div class="row m-1 p-2 ">
                        <div class="col-2">Order Status</div>
                        <div class="col-1">:</div>
                        <div class="col-9">
                            {{ $order->status == 0 ? 'Processing' : ($order->status == 1 ? 'Dispatched' : 'Delivered') }}
                        </div>
                    </div>
                    <div class="row m-1 p-2 bg-light">
                        <div class="col-2">Update Status</div>
                        <div class="col-1">:</div>
                        <div class="col-9">
                            @if($errors->has('order'))
                                <span class="text-danger">{{$errors->first('order')}}</span>
                            @endif
                            @if($errors->has('status'))
                                <span class="text-danger">{{$errors->first('status')}}</span>
                            @endif
                            <form action="{{route('manage-status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="order" value="{{$order->id}}">
                                <input type="radio"  {{$order->status >= 1 ? 'disabled' :''}}  name="status" id="dispatch" value="1" class="input-check">
                                <label for="dispatch">Disptach</label>
                                <input type="radio"  {{$order->status >= 2 ? 'disabled' :''}} name="status" id="delivered" value="2" class="input-check">
                                <label for="delivered">Delivered</label>
                                <button class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection
