@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.books.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Edit
        book: {{ $book->name }}
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.books.index') }}">Books</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-xs-6">
                    <div class="col-xs-12 @include('layout.components.validation_color', ['name' => 'name'])">
                        <label>Name</label>
                        <input class="form-control" type="text"
                               value="{{ $book->name }}"
                               placeholder="Enter name" name="name">
                        @include('layout.components.validation_error', ['name' => 'name'])
                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'isbn'])">
                        <label>ISBN</label>
                        <input class="form-control" type="text" placeholder="Enter ISBN" name="isbn"
                               value="{{ $book->isbn }}">
                        @include('layout.components.validation_error', ['name' => 'isbn'])
                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'isbn'])">
                        <label>Author</label>
                        <input class="form-control" type="text" placeholder="Enter author" name="author"
                               value="{{ $book->author_name }}">
                        @include('layout.components.validation_error', ['name' => 'author'])
                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'genre'])">
                        <label>Genre</label>
                        <select class="form-control" name="genre">
                            @foreach( $genres as $gen)
                                <option value="{{ $gen->id }}" {{ ($book->genre && $book->genre->id == $gen->id) ? 'selected' : ''}}>
                                    {{ $gen->name }}</option>
                            @endforeach
                        </select>
                        @include('layout.components.validation_error', ['name' => 'genre'])
                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'focus_level'])">
                        <span href="#" data-toggle="tooltip"
                              title="Number which sets how far from center will be book generated. Number from 1 to 5">
                            <label>Generation focus level <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter level" name="focus_level"
                               value="{{ $book->generation_focus_level }}" max="5" min="1">
                        @include('layout.components.validation_error', ['name' => 'focus_level'])

                    </div>

                </div>
                <div class="col-xs-6">
                    <div class="col-xs-5">
                        <label for="profile_photo">Book cover</label>
                        <input class="form-control" type="file" id="profile_photo" name="book_cover">
                    </div>
                    <div class="col-xs-6 col-xs-offset-1">
                        <a data-toggle="modal" href="" data-target="#cover"><img src="{{ $book->avatarUrl }}" class="table_image center-block"/></a>
                        <div class="modal fade" id="cover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Book</h4>
                                    </div>
                                    <div class="modal-body">
                                        <img class="center-block" src="{{ $book->avatarUrl }}"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'year_published'])">
                        <label>Year published</label>
                        <input class="form-control" type="number" max="2020" placeholder="Enter level"
                               name="year_published"
                               value="{{ $book->year_published }}">
                        @include('layout.components.validation_error', ['name' => 'year_published'])
                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'energy'])">
                        <span href="#" data-toggle="tooltip"
                              title="Energy needed to add book to library.">
                            <label>Energy for clearing <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter amount of energy" name="energy"
                               value="{{ $book->energy_for_clearing }}" max="200" min="1">
                        @include('layout.components.validation_error', ['name' => 'energy'])

                    </div>
                    <div class="col-xs-12  @include('layout.components.validation_color', ['name' => 'time_clearing'])">
                        <span href="#" data-toggle="tooltip"
                              title="Time that will be needed for picking up book and start clearing it. (Helpers time)">
                            <label>Time for clearing <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter time in sec" name="time_clearing"
                               value="{{ $book->time_for_clearing }}" max="3600" min="1">
                        @include('layout.components.validation_error', ['name' => 'time_clearing'])

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-quirk pull-right"><i class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="box">
        <div class="box-body">

            <h2>Identify text quiz</h2>
            @empty($identifyTextQuiz)
                <a class="btn btn-success pull-left margin"
                   href="{{ route('admin.identifyText.create', ['id' => $book->id]) }}">Add identify text quiz</a>
                @endempty
                @isset($identifyTextQuiz)
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Correct text</th>
                        <th>Incorrect text</th>
                        <th>Energy loss</th>
                        <th>Points to obtain for word</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $identifyTextQuiz->id }}</td>
                        <td>{{ $identifyTextQuiz->correct_quiz }}</td>
                        <td>{{ $identifyTextQuiz->incorrect_quiz }}</td>
                        <td>{{ $identifyTextQuiz->energy_loss }}</td>
                        <td>{{ $identifyTextQuiz->points_to_obtain_for_word}}</td>
                        <td>{{ $identifyTextQuiz->created_at}}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.identifyText.edit', ['id' => $book->id, 'quizId' => $identifyTextQuiz->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger confirm" data-confirm="Do you really want to delete this?"
                               href="{{ route('admin.identifyText.delete', ['id' => $book->id, 'quizId' => $identifyTextQuiz->id]) }}">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                @endisset

        </div>
    </div>

    <div class="box">
        <div class="box-body">

            <h2>Identify character quiz</h2>
                @empty($identifyCharacterQuiz)
                <a class="btn btn-success pull-left margin"
                   href="{{ route('admin.identifyCharacter.create', ['id' => $book->id]) }}">Add identify character quiz</a>
                @endempty
                @isset($identifyCharacterQuiz)
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Answers</th>
                        <th>Correct answers</th>
                        <th>Max points</th>
                        <th>Unlock rate</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $identifyCharacterQuiz->id }}</td>
                        <td>{{ $identifyCharacterQuiz->answers }}</td>
                        <td>{{ $identifyCharacterQuiz->correct_answers }}</td>
                        <td>{{ $identifyCharacterQuiz->max_points_obtain }}</td>
                        <td>{{ $identifyCharacterQuiz->unlock_rate}}</td>
                        <td>{{ $identifyCharacterQuiz->created_at}}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.identifyCharacter.edit', ['id' => $book->id, 'quizId' => $identifyCharacterQuiz->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger confirm" data-confirm="Do you really want to delete this?"
                               href="{{ route('admin.identifyCharacter.delete', ['id' => $book->id, 'quizId' => $identifyCharacterQuiz->id]) }}">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                @endisset

        </div>
    </div>

    <div class="box">
        <div class="box-body">

            <h2>Mini quiz</h2>
            @empty($miniQuiz)
                <a class="btn btn-success pull-left margin"
                   href="{{ route('admin.miniQuiz.create', ['id' => $book->id]) }}">Add mini quiz</a>
                @endempty
                @isset($miniQuiz)
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bonus</th>
                        <th>Energy loss</th>
                        <th>Unlock rate</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $miniQuiz->id }}</td>
                        <td>{{ $miniQuiz->bonus_points }}</td>
                        <td>{{ $miniQuiz->energy_loss }}</td>
                        <td>{{ $miniQuiz->unlock_rate}}</td>
                        <td>{{ $miniQuiz->created_at}}</td>
                        <td class="actions"><a type="button" class="btn-sm btn-primary"
                                               href="{{ route('admin.miniQuiz.edit', ['id' => $book->id, 'quizId' => $miniQuiz->id]) }}">Edit</a>
                            <a type="button" class="btn-sm btn-danger confirm" data-confirm="Do you really want to delete this?"
                               href="{{ route('admin.miniQuiz.delete', ['id' => $book->id, 'quizId' => $miniQuiz->id]) }}">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                @endisset

        </div>
    </div>
@endsection