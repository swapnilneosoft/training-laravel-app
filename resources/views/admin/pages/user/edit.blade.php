@extends('admin.master.master',["sidebarLink"=>["main"=>'user',"active"=>'edit']])
@section('title')
    Update User
@endsection
@section('page-content-heading')
    Update User
@endsection
@section('page-content-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user-list') }}">User List</a></li>
    <li class="breadcrumb-item active">Edit User </li>
@endsection
@section('page-content')
    <div class="container">

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="fname">Firstname</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                    class="form-control {{ $errors->has('firstname') ? 'border border-danger' : '' }}"
                                    id="fname" name="firstname" value="{{ $user->firstname }}">
                            </div>
                            @if ($errors->has('firstname'))
                                <div class="col-12 text-danger text-center alert-box">{{ $errors->first('firstname') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="lname">Lastname</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                    class="form-control  {{ $errors->has('lastname') ? 'border border-danger' : '' }}"
                                    id="lname" name="lastname" value="{{ $user->lastname }} ">
                            </div>
                            @if ($errors->has('lastname'))
                                <div class="col-12 text-danger text-center alert-box">{{ $errors->first('lastname') }}</div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                    class="form-control  {{ $errors->has('email') ? 'border border-danger' : '' }}"
                                    id="email" name="email" value="{{ $user->email }}">
                            </div>
                            @if ($errors->has('email'))
                                <div class="col-12 text-danger text-center alert-box">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-9">
                                <input type="password"
                                    class="form-control  {{ $errors->has('password') ? 'border border-danger' : '' }}"
                                    id="password" name="password">
                            </div>
                            @if ($errors->has('password'))
                                <div class="col-12 text-danger text-center alert-box">{{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="cnfPass">Confirm Password</label>
                            </div>
                            <div class="col-9">
                                <input type="password"
                                    class="form-control  {{ $errors->has('firstname') ? 'border border-danger' : '' }}"
                                    id="cnfPass" name="confirm_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3 col-form-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1" name="status"
                                            checked value="1">
                                        <label for="customRadio1" class="custom-control-label">Active</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2" name="status"
                                            value="0" {{ $user->status == 0 ? 'checked' : '' }}>
                                        <label for="customRadio2" class="custom-control-label">Inactive</label>
                                    </div>
                                </div>

                                @if ($errors->has('status'))
                                    <div class="col-12 text-danger text-center alert-box">{{ $errors->first('status') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="role">Role</label>
                                </div>
                                <div class="col-6">
                                    <select name="role_id" id="role" class="form-control text-capitalize">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if ($errors->has('role'))
                                    <div class="col-12 text-danger text-center alert-box">{{ $errors->first('role') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn  btn-success form-control" style="width: 70%">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
