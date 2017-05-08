@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.libraries.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Create library
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.libraries.index') }}">Library</a></li>
        <li class="active">Create</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.libraries.store') }}" method="post">
                {{ csrf_field() }}
                <div class="row col-xs-12">
                    <div class="col-xs-12 @include('layout.components.validation_color', ['name' => 'name'])">
                        <label>Name</label>
                        <input class="form-control" type="text"
                               value="{{ old('name') }}"
                               placeholder="Enter name" name="name">
                        @include('layout.components.validation_error', ['name' => 'name'])
                    </div>
                    <hr class="col-xs-12">
                    <div class="col-xs-5  @include('layout.components.validation_color', ['name' => 'email'])">
                        <label for="url">Url</label>
                        <input class="form-control" type="text" placeholder="Enter url" name="url"
                               value="{{ old('url') }}">
                        @include('layout.components.validation_error', ['name' => 'url'])
                    </div>
                    <div class="col-xs-5 @include('layout.components.validation_color', ['name' => 'database_name'])">
                        <label>Database name</label>
                        <input class="form-control" type="text" placeholder="Enter database name"
                               name="database_name" autocomplete="off"
                               value="{{ old('database_name') }}">
                        @include('layout.components.validation_error', ['name' => 'database_name'])
                    </div>
                    <div class="col-xs-2 @include('layout.components.validation_color', ['name' => 'port'])">
                        <label>Port</label>
                        <input class="form-control" type="number" placeholder="Enter port"
                               name="port"
                               value="{{ old('port') }}">
                        @include('layout.components.validation_error', ['name' => 'port'])
                    </div>
                    <hr class="col-xs-12">
                    <div class="col-xs-5 @include('layout.components.validation_color', ['name' => 'street'])">
                        <label>Street</label>
                        <input class="form-control" type="text" placeholder="Enter street"
                               name="street"
                               value="{{ old('street') }}">
                        @include('layout.components.validation_error', ['name' => 'street'])
                    </div>

                    <div class="col-xs-2 @include('layout.components.validation_color', ['name' => 'street_number'])">
                        <label>Street number</label>
                        <input class="form-control" type="text" placeholder="Enter street number"
                               name="street_number"
                               value="{{ old('street_number') }}">
                        @include('layout.components.validation_error', ['name' => 'street_number'])
                    </div>

                    <div class="col-xs-5 @include('layout.components.validation_color', ['name' => 'city'])">
                        <label>City</label>
                        <input class="form-control" type="text" placeholder="Enter city"
                               name="city"
                               value="{{ old('city') }}">
                        @include('layout.components.validation_error', ['name' => 'city'])
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-quirk pull-right"><i class="fa fa-save"></i>
                            Save
                        </button>
                        <a id="test-library" class="btn btn-info">Test connection</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

