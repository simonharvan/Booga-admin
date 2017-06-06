@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.levels.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Edit Level
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.levels.index') }}">Levels</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.levels.update', $level->id ) }}" method="post">
                {{ csrf_field() }}
                <div class="col-xs-12">
                    <div class="col-xs-6">
                        <label>Name</label>
                        <input class="form-control" type="text"
                               value="{{ old('name', $level->name) }}"
                               placeholder="Enter name of level (e.g.: 2)" name="name">
                    </div>
                    <div class="col-xs-6">
                        <label>Minimum points</label>
                        <input class="form-control" type="number" placeholder="Enter minimum points to achieve level" name="min_points"
                               value="{{ old('min_points', $level->min_points) }}" min="0">
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