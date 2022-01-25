@extends('admin.master.master',["sidebarLink"=>["main"=>'category',"active"=>'listSubCategory']])
@section('title')
    Sub Category update
@endsection
@section('page-content-heading')
    Sub Category update
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sub-category-list') }}">Sub Category list</a></li>
    <li class="breadcrumb-item active">Sub Category update </li>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-2"></div>
        <div class="col-6 card">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Sub category Name</label>
                    <input type="text" value="{{ $sub->name }}" name="name" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="cat">Select Category</label>
                    <select name="category_id" class="form-control" id="">
                        <option value="">Selecr Category</option>
                        @foreach ($cat as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $sub->category_id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-dark" style="width: 70%">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
