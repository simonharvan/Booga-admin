@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Levels
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Levels</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <a class="btn btn-success pull-right margin" href="{{ route('admin.levels.create') }}">Add level</a>

            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Min points</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($levels as $level)
                    <tr>
                        <td>{{ $level->name }}</td>
                        <td>{{ $level->min_points }}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.levels.edit', ['id' => $level->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger confirm" data-confirm="Do you really want to delete this level?"
                               href="{{ route('admin.levels.delete', ['id' => $level->id]) }}">Delete</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $levels->links() }}
            </div>
        </div>
    </div>
@endsection