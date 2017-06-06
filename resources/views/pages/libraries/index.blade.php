@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Libraries
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Libraries</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <a class="btn btn-success pull-right margin" href="{{ route('admin.libraries.create') }}">Add library</a>

            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Database name</th>
                    <th>Port</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Street number</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($libraries as $library)
                    <tr data-href="{{ route('admin.admins.edit', ['id' => $library->id]) }}">
                        <td>{{ $library->id }}</td>
                        <td>{{ $library->name }}</td>
                        <td>{{ $library->url }}</td>
                        <td>{{ $library->database_name }}</td>
                        <td>{{ $library->port }}</td>
                        <td>{{ $library->street }}</td>
                        <td>{{ $library->city }}</td>
                        <td>{{ $library->street_number }}</td>
                        <td>{{ $library->created_at }}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.libraries.edit', ['id' => $library->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger confirm" data-confirm="Do you really want to delete?"
                               href="{{ route('admin.libraries.delete', ['id' => $library->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $libraries->links() }}
            </div>
        </div>
    </div>
@endsection