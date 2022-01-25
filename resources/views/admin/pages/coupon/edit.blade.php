@extends('admin.master.master',["sidebarLink"=>["main"=>'coupon',"active"=>'listCoupon']])
@section('title')
    Update Coupon
@endsection
@section('page-content-heading')
    Update Coupon
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('coupon-list') }}">Coupon List</a></li>
    <li class="breadcrumb-item active">Update Coupon </li>
@endsection
@section('page-content')


    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6 card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}">
                            <small class="text-secondary">blank code field will be automatically genarate 12 digit code
                            </small>
                            @if ($errors->has('code'))
                                <span class="alert-danger">{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity"
                                value="{{ $coupon->quantity }}">
                            <small class="text-secondary">Blank quantity considered as unlimited coupons</small>
                            @if ($errors->has('quantity'))
                                <span class="alert-danger">{{ $errors->first('quantity') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="percentage" class="text-secondary">Descount type</label>
                            <input type="radio" class=" input-check" id="dis1" name="percentage" value="1" checked><label
                                for="dis1">Percentage</label>
                            <input type="radio" class=" input-check" id="dis2" name="percentage" value="0"
                                {{ $coupon->percentage == 1 ? '' : 'checked' }}><label for="dis2">In Rupees</label>
                            @if ($errors->has('percentage'))
                                <span class="alert-danger">{{ $errors->first('percentage') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="discount">Coupon Discount</label>
                            <input type="text" class="form-control" id="discount" name="discount"
                                value="{{ $coupon->discount }}">
                            <small class="text-danger">Please select appropriate discount. (for percenatage discount
                                should be less than 100)</small>
                            @if ($errors->has('discount'))
                                <span class="alert-danger">{{ $errors->first('discount') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0" {{ $coupon->status == 1 ? '' : 'selected' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="max_disc">Maximum discount <small>In INR</small></label>
                            <input type="text" class="form-control" name="max_disc" id="max_disc"
                                value="{{ $coupon->max_disc }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success form-control">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
