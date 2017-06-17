@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.tableOfFame.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Profile
        of {{ $user->name }}
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.tableOfFame.index') }}">Table of fame</a></li>
        <li class="active">{{ $user->name }}</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="col-lg-6 col-xs-12">
                <div class="col-xs-12 @include('layout.components.validation_color', ['name' => 'name'])">
                    <label>Name</label>
                    <input class="form-control" type="text"
                           value="{{ old('name', $user->name) }}"
                           placeholder="Enter name" name="name" disabled>
                    @include('layout.components.validation_error', ['name' => 'name'])
                </div>
                <div class="col-xs-12 @include('layout.components.validation_color', ['name' => 'email'])">
                    <label>Email</label>
                    <input class="form-control" type="text" placeholder="Enter email" name="email"
                           value="{{ old('email',$user->email) }}" disabled>
                    @include('layout.components.validation_error', ['name' => 'email'])
                </div>
                <div class="col-xs-12 checkbox">
                    <label>
                        <input class="checkbox" type="checkbox" name="superadmin"
                               value="true" disabled @php
                            if ($user->superadmin) {
                                echo "checked";
                            } @endphp
                        > Super admin
                    </label>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="col-xs-12">
                    <img class="col-xs-6 col-xs-offset-3" src="{{ $user->avatarUrl }}">
                </div>
            </div>
            <hr class="col-xs-12">
            <div class="col-xs-12">
                <h3>Achievements</h3>
                <p><strong>Points:</strong> {{ $user->points }}</p>
                <p><strong>Badges:</strong>
                <div class="col-lg-6 col-xs-12">
                    <table class="table table-striped ">
                        <thead>

                        <th>Name</th>
                        <th>Description</th>
                        <th>Done</th>
                        </thead>
                        <tbody>

                        @foreach($badgeTypes as $badgeType)
                            @php
                                $done = false
                            @endphp
                            <tr>
                                <td>{{ $badgeType->name }}</td>
                                <td>{{ $badgeType->description }}</td>
                                @foreach($adminBadges as $adminBadge)
                                    @php
                                        if ($badgeType->id == $adminBadge->admin_badge_type_id){
                                            $done = true;
                                        }
                                    @endphp
                                @endforeach
                                @if($done)
                                    <td><i class="fa phpdebugbar-fa-check-circle"></i></td>
                                @else
                                    <td><i class="fa phpdebugbar-fa-times-circle"></i></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </p>

            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{ route('admin.tableOfFame.index') }}"
                       class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection