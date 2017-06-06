@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.levels.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Create Level
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.levels.index') }}">Levels</a></li>
        <li class="active">Add</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.levels.store') }}" method="post">
                {{ csrf_field() }}
                <div class="col-xs-12">
                    <div class="col-xs-6">
                        <label>Name</label>
                        <input class="form-control" type="text"
                               value="{{ old('name') }}"
                               placeholder="Enter name of level" name="name">
                        <i class="small">Last level name: {{ $last_level->name }}</i>
                    </div>
                    <div class="col-xs-6">
                        <label>Minimum points</label>
                        <input class="form-control" type="number" placeholder="Enter minimum points to achieve level (last level minimum: {{ $last_level->min_points }})" name="min_points"
                               value="{{ old('min_points') }}" min="{{ $last_level->min_points }}">
                        <i class="small">Last level minimum points: {{ $last_level->min_points }}</i>
                    </div>
                    <div class="col-xs-12 margin-top">
                        <button type="submit" class="btn btn-success btn-quirk pull-right"><i
                                    class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection