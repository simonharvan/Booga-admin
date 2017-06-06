@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.avatars.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Edit Avatar
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.avatars.index') }}">Avatars</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.avatars.update', $avatar->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-xs-6">
                    <div class="col-xs-12 no-padding @include('layout.components.validation_color', ['name' => 'name'])">
                        <label>Name</label>
                        <input class="form-control" type="text"
                               value="{{ old('name', $avatar->name) }}"
                               placeholder="Enter name" name="name">
                        @include('layout.components.validation_error', ['name' => 'name'])
                    </div>
                    <div class="col-xs-12  no-padding @include('layout.components.validation_color', ['name' => 'description'])">
                        <label>Description</label>
                        <input class="form-control" type="text" placeholder="Enter description" name="description"
                               value="{{ old('description', $avatar->description) }}">
                        @include('layout.components.validation_error', ['name' => 'description'])
                    </div>

                </div>
                <div class="col-xs-6">
                    <div class="col-xs-12 no-padding ">
                        <label for="book_cover">Avatar</label>
                        <input class="form-control col-xs-3" type="file" id="profile_photo" name="profile_photo">
                    </div>
                    <div class="col-xs-12 no-padding">
                        <a data-toggle="modal" data-target="#profile"><img src="{{ $avatar->avatarUrl }}"
                                                                           class="table_image center-block"/></a>
                    </div>
                    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Avatar</h4>
                                </div>
                                <div class="modal-body">
                                    <img class="center-block" src="{{ $avatar->avatarUrl }}"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-quirk pull-right"><i class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection