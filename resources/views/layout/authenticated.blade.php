@extends('layout.core')

@section('core_content')
    <div class="wrapper">
        @include('layout.components.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('layout.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('breadcrumbs')
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layout.components.footer')
    </div>
@endsection