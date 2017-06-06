@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.books.edit', ['id' => $book->id]) }}"><i class="fa fa-arrow-circle-left"></i></a>
        Edit identify text quiz for book: {{ $book->name }}
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.books.index') }}">Books</a></li>
        <li><a href="{{ route('admin.books.edit', ['id' => $book->id]) }}">{{ $book->name }}</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="store-identify-text" action="{{ route('admin.identifyText.update', [ 'id' => $book->id, 'quizId' => $identifyTextQuiz->id ]) }}"
                  method="post">
                {{ csrf_field() }}

                <input type="hidden" name="correct_words" id="correct-words" value="{{ $identifyTextQuiz->correct_words }}">
                <div class="row col-xs-12">
                    <div class="col-xs-12">
                        <label>Incorrect text</label>
                        <textarea class="form-control incorrect-text" type="text"
                                  value="{{ $identifyTextQuiz->incorrect_quiz }}"
                                  placeholder="Enter incorrect text" name="incorrect"></textarea>
                    </div>
                    <div class="generated-text">
                        <hr class="col-xs-12">
                        <div class="col-xs-12">
                        <span href="#" data-toggle="tooltip"
                              title="Click on incorrect words to select them">
                            <label>Incorrect words <i class="fa fa-question-circle"></i> </label>
                        </span>
                            <br>
                            <span class="incorrect-words" name="words"></span>
                        </div>
                    </div>
                    <hr class="col-xs-12">
                    <div class="col-xs-12">
                        <label>Correct text</label>
                        <textarea class="form-control" type="text"
                                  value="{{ $identifyTextQuiz->correct_quiz }}"
                                  placeholder="Enter correct text" name="correct"></textarea>
                    </div>
                    <hr class="col-xs-12">
                    <div class="col-xs-4">
                        <label>Energy loss</label>
                        <input class="form-control" type="number" placeholder="Enter energy loss"
                               name="energy_loss"
                               value="{{ $identifyTextQuiz->energy_loss }}" min="0">
                    </div>

                    <div class="col-xs-4 ">
                        <label>Points to obtain for word</label>
                        <input class="form-control" type="number" placeholder="Enter points"
                               name="points"
                               value="{{ $identifyTextQuiz->points_to_obtain_for_word }}" min="0">
                    </div>

                    <div class="col-xs-4">
                        <span href="#" data-toggle="tooltip"
                              title="Number which sets how much points you need for quiz to be successful">
                            <label>Unlock rate <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter unlock rate"
                               name="unlock"
                               value="{{ $identifyTextQuiz->unlock_rate }}" min="0">
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

@endsection

