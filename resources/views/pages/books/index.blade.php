@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Books
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Books</li>
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
                    <th>Author</th>
                    <th>Year published</th>
                    <th>ISBN</th>
                    <th>State</th>
                    <th>Book cover</th>
                    <th>Level</th>
                    <th>Energy for clearing</th>
                    <th>Time for clearing</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr data-href="{{ route('admin.admins.edit', ['id' => $book->id]) }}">
                        <th>{{ $book->id }}</th>
                        <th>{{ $book->name }}</th>
                        <th>{{ $book->author_name }}</th>
                        <th>{{ $book->year_published }}</th>
                        <th>{{ $book->isbn }}</th>
                        <th><span class="{{ strtolower($book->state) }}">{{ $book->state }}</span></th>
                        <th><a href="{{ $book->book_cover_url }}"><img src="{{ $book->book_cover_url }}" class="book_cover center-block"/></a></th>
                        <th>{{ $book->generation_focus_level }}</th>
                        <th>{{ $book->energy_for_clearing }}</th>
                        <th>{{ $book->time_for_clearing }}</th>
                        <th>{{ $book->created_at }}</th>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                               href="{{ route('admin.admins.edit', ['id' => $book->id]) }}">Edit</a>
                        <a type="button" class="btn-sm btn-danger"
                               href="{{ route('admin.admins.delete', ['id' => $book->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection