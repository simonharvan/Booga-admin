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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Points</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr data-href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->points }}</td>
                        <td><a type="button" class="btn btn-primary" href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">Edit</a></td>
                        <td><a type="button" class="btn btn-danger" href="{{ route('admin.admins.delete', ['id' => $admin->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection