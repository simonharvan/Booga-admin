@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Citations
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Citations</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <a class="btn btn-success pull-right margin" href="{{ route('admin.citations.create') }}">Add citation</a>

            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Text</th>
                    <th>Author</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Genre</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($citations as $citation)
                    <tr>
                        <td>{{ $citation->id }}</td>
                        <td>{{ $citation->text }}</td>
                        <td>{{ $citation->author }}</td>
                        <td>{{ $citation->from }}</td>
                        <td>{{ $citation->to}}</td>
                        <td>{{ isset($citation->genre) ? $citation->genre->name : 'Without genre'}}</td>
                        <td>{{ $citation->created_at}}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.citations.edit', ['id' => $citation->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger"
                               href="{{ route('admin.citations.delete', ['id' => $citation->id]) }}">Delete</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $citations->links() }}
            </div>
        </div>
    </div>
@endsection