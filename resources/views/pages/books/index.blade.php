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

            <a class="btn btn-success pull-right margin" href="{{ route('admin.books.create') }}">Add book</a>

            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Year published</th>
                    <th>ISBN</th>
                    <th>Identify text quiz</th>
                    <th>Identify character quiz</th>
                    <th>Mini quiz</th>
                    <th>Book cover</th>
                    <th>Level</th>
                    <th>Energy for clearing</th>
                    <th>Time for clearing</th>
                    <th>Created at</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr data-href="{{ route('admin.books.edit', ['id' => $book->id]) }}">
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author_name }}</td>
                        <td>{{ $book->year_published }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>
                            @if (isset($book->identifyTextQuiz))
                                <i class="fa fa-check-circle"></i>
                            @else
                                <i class="fa fa-times"></i>
                            @endif
                        </td>
                        <td>
                            @if (isset($book->identifyCharacterQuiz))
                                <i class="fa fa-check-circle"></i>
                            @else
                                <i class="fa fa-times"></i>
                            @endif
                        </td>
                        <td>
                            @if (isset($book->miniQuiz))
                                <i class="fa fa-check-circle"></i>
                            @else
                                <i class="fa fa-times"></i>
                            @endif
                        </td>
                        <td>
                            <img src="{{ $book->avatarUrl }}" class="table_image center-block"/>
                        </td>
                        <td>{{ $book->generation_focus_level }}</td>
                        <td>{{ $book->energy_for_clearing }}</td>
                        <td>{{ $book->time_for_clearing }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.books.edit', ['id' => $book->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger"
                               href="{{ route('admin.books.delete', ['id' => $book->id]) }}">Delete</a></td>
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