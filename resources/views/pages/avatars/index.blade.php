@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Avatars
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Avatars</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <a class="btn btn-success pull-right margin" href="{{ route('admin.avatars.create') }}">Add avatar</a>

            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($avatars as $avatar)
                    <tr data-href="{{ route('admin.avatars.edit', ['id' => $avatar->id]) }}">
                        <td>{{ $avatar->id }}</td>
                        <td>{{ $avatar->name }}</td>
                        <td>{{ $avatar->description }}</td>
                        <td><a href="{{ $avatar->avatarUrl }}"><img src="{{ $avatar->avatarUrl }}"
                                                                  class="table_image center-block"/></a></td>
                        <td>{{ $avatar->created_at }}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.avatars.edit', ['id' => $avatar->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger"
                               href="{{ route('admin.avatars.delete', ['id' => $avatar->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $avatars->links() }}
            </div>
        </div>
    </div>
@endsection