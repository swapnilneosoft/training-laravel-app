@extends('admin.master.master',["sidebarLink"=>["main"=>'category',"active"=>'listCategory']])
@section('title')
    Update category
@endsection
@section('page-content-heading')
    Update Category
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('category-list') }}">Category List</a></li>
    <li class="breadcrumb-item active">Update Category </li>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6 card">
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                    @if ($errors->has('name'))
                        <span class="alert-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-dark form-control">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
