@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Table of fame
        <small>Only the strongest shall make it to the top </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Table of fame</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <table id="admins-table" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Position</th>
                    <th>Points</th>
                    <th>Name</th>
                    <th>Superadmin</th>
                    <th>Profile photo</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)

                    <tr data-href="{{ route('admin.profile.detail', ['id' => $admin->id]) }}">
                        <td>{{ $count++ }}</td>
                        <td>{{ $admin->points }}</td>
                        <td>{{ $admin->name }}</td>
                        @if ($admin->superadmin)
                            <td><i class="fa phpdebugbar-fa-check"></i></td>
                        @else
                            <td><i class="fa phpdebugbar-fa-times"></i></td>
                        @endif
                        <td><img src="{{ $admin->avatarUrl }}" class="table_image"></td>
                        <td>{{ $admin->created_at }}</td>
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
