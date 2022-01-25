@extends('admin.master.master',["sidebarLink"=>["main"=>'',"active"=>'dashboard']])
@section('title')
    Dashboard
@endsection
@section('page-content-heading')
    <span class="text-secondary">Dashboard</span>
@endsection
@section('page-content-breadcrumb')

    <li class="breadcrumb-item active">Home </li>
@endsection
@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-12 card p-0">
                <div class="card-header">
                    <h4>Reports</h4>
                </div>
                <div class="card-body">
                    <div class="row p-2 m-2">
                        <div class="col-5">
                            <form action="{{route('sales-report')}}" method="post">
                                @csrf
                                <button class="btn btn-lg btn-info">Get Sales Reports</button>
                            </form>
                        </div>
                    </div>
                    <div class="row p-2 m-2">
                        <div class="col-5">
                            <form action="{{route('used-coupon-report')}}" method="post">
                                @csrf
                                <button class="btn btn-lg btn-primary">Get Coupon used Reports</button>
                            </form>
                        </div>
                    </div>
                    <div class="row p-2 m-2">
                        <div class="col-5">
                            <form action="{{route('customer-report')}}" method="post">
                                @csrf
                                <button class="btn btn-lg btn-success">Get Customer Registered Reports</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
