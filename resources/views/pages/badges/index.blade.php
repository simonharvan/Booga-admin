@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Badges
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Badges</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <a class="btn btn-success pull-right margin" href="{{ route('admin.badges.create') }}">Add badge</a>

            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Picture</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($badges as $badge)
                    <tr data-href="{{ route('admin.avatars.edit', ['id' => $badge->id]) }}">
                        <td>{{ $badge->id }}</td>
                        <td>{{ $badge->name }}</td>
                        <td>{{ $badge->description }}</td>
                        <td><a href="{{ $badge->avatarUrl }}"><img src="{{ $badge->avatarUrl }}"
                                                                    class="table_image center-block"/></a></td>
                        <td>{{ $badge->created_at }}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.badges.edit', ['id' => $badge->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger"
                               href="{{ route('admin.badges.delete', ['id' => $badge->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $badges->links() }}
            </div>
        </div>
    </div>
@endsection