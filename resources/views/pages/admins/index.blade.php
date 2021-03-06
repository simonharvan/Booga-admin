@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        Admins
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admins</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <a class="btn btn-success pull-right margin" href="{{ route('admin.admins.create') }}">Add admin</a>

            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Points</th>
                    <th>Superadmin</th>
                    <th>Profile photo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr data-href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->points }}</td>
                        @if ($admin->superadmin)
                            <td><i class="fa phpdebugbar-fa-check"></i></td>
                        @else
                            <td><i class="fa phpdebugbar-fa-times"></i></td>
                        @endif
                        <td><img src="{{ $admin->avatarUrl }}" class="table_image"></td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger"
                               href="{{ route('admin.admins.delete', ['id' => $admin->id]) }}">Delete</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $admins->links() }}
            </div>
        </div>
    </div>
@endsection