@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.admins.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Create admin
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.admins.index') }}">Admins</a></li>
        <li class="active">Add</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-xs-6">
                    <div class="col-xs-12 @include('layout.components.validation_color', ['name' => 'name'])">
                        <label>Name</label>
                        <input class="form-control" type="text"
                               value="{{ old('name') }}"
                               placeholder="Enter name" name="name">
                        @include('layout.components.validation_error', ['name' => 'name'])
                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'email'])">
                        <label>Email</label>
                        <input class="form-control" type="text" placeholder="Enter email" name="email"
                               value="{{ old('email') }}">
                        @include('layout.components.validation_error', ['name' => 'email'])
                    </div>
                    <div class="col-xs-12 @include('layout.components.validation_color', ['name' => 'password'])">
                        <label>Password</label>
                        <input class="form-control" type="password" placeholder="Enter password" name="password"
                               value="">
                        @include('layout.components.validation_error', ['name' => 'password'])
                    </div>
                    <div class="col-xs-12 checkbox">
                        <label>
                            <input class="checkbox" type="checkbox" name="superadmin"
                                   value="true"> Super admin
                        </label>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="col-xs-12">
                        <label for="profile_photo">Profile photo</label>
                        <input class="form-control" type="file" id="profile_photo" name="profile_photo">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-quirk pull-right"><i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection