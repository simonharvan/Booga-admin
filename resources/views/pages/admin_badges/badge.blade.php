@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        Wow! You have earned new Badge
    </h1>
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="jumbotron col-lg-8 col-lg-offset-2 col-xs-12">
            <h1>{{ $adminBadgeType->name }}</h1>
            <p>{{ $adminBadgeType->description }}</p>
            <p><a class="btn btn-primary btn-lg" href="{{ route($redirect) }}" role="button">Continue working</a></p>
        </div>
    </div>
    <!-- /.row -->

@endsection