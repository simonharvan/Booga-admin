@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Logs
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Logs</li>
    </ol>
@endsection

@section('content')
    <script>
        $(document).ready(function () {
            $('a[href="#admin-logs"]').click(function (e) {
                e.preventDefault();
                $('#admin-logs').tab('show');
            });
            $('a[href="#player-logs"]').click(function (e) {
                e.preventDefault();
                $('#player-logs').tab('show');
            });
        });

    </script>
    <div class="box">
        <div class="box-body">

            <h2>Logs</h2>
            <ul class="nav nav-tabs" id="log-tabs">
                <li class="active" ><a href="#admin-logs" data-toggle="tab">Admins</a></li>
                <li><a href="#player-logs" data-toggle="tab">Players</a></li>
            </ul>
            <div class="tab-content">
                <div id="admin-logs" class="tab-pane active fade in">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Text</th>
                            <th>Type</th>
                            <th>Admin</th>
                            <th>Created at</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($adminLogs as $adminLog)
                            <tr>
                                <td>{{ $adminLog->id }}</td>
                                <td>{{ $adminLog->text }}</td>
                                <td>{{ $adminLog->type }}</td>
                                <td>{{ $adminLog->admin->name }}</td>
                                <td>{{ $adminLog->created_at }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $adminLogs->links() }}
                    </div>
                </div>
                <div id="player-logs" class="tab-pane fade">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Text</th>
                            <th>Type</th>
                            <th>Admin</th>
                            <th>Created at</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="pull-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection