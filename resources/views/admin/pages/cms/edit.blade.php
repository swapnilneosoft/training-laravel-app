@extends('admin.master.master',["sidebarLink"=>["main"=>'cms',"active"=>'listCms']])
@section('title')
    Content Managment
@endsection
@section('page-content-heading')
    Content Managment
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cms-list') }}"> Content Managment List</a></li>
    <li class="breadcrumb-item active"> Content Managment Edit </li>
@endsection
@section('page-content')

    <div class="container">
        <div class="row card">
            <div class="col-12 card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="{{$cms->id}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text"
                                    class="form-control {{ $errors->has('title') ? 'border border-danger' : ' ' }}"
                                    name="title" title="{{ $errors->first('title') }}" placeholder="Title"
                                    value="{{ $cms->title }}">
                                @if ($errors->has('title'))
                                    <span class="alert-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea type="text" cols="12" rows="5" style="resize: none"
                                    class="form-control {{ $errors->has('description') ? 'border border-danger' : ' ' }}"
                                    name="description" title="{{ $errors->first('description') }}"
                                    placeholder="description">{{ $cms->description }}{{ $cms->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="alert-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success" style="float: right"> <i class="fas fa-plus-circle m-1"></i>
                                Update
                                CMS</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
