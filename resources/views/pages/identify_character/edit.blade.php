@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.books.edit', ['id' => $book->id]) }}"><i class="fa fa-arrow-circle-left"></i></a>
        Edit identify character quiz for book: {{ $book->name }}
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
            <form class="store-identify-character-quiz"
                  action="{{ route('admin.identifyCharacter.update', [ 'id' => $book->id, 'quizId' => $identifyCharacterQuiz->id ]) }}"
                  method="post">
                {{ csrf_field() }}
                <input type="hidden" name="json" id="json">
                <div class="row col-xs-12">
                    <div class="col-xs-6 ">
                        <span href="#" data-toggle="tooltip"
                              title="Maximum points if player does quiz 100%">
                            <label>Maximum points to obtain<i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter points"
                               name="points"
                               value="{{ $identifyCharacterQuiz->max_points_obtain }}" min="0">
                    </div>

                    <div class="col-xs-6">
                        <span href="#" data-toggle="tooltip"
                              title="Number which sets how much points you need for quiz to be successful">
                            <label>Unlock rate <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter unlock rate"
                               name="unlock"
                               value="{{ $identifyCharacterQuiz->unlock_rate }}" min="0">
                    </div>
                    <hr class="col-xs-12">
                </div>


                <h3 class="col-xs-12">Answers</h3>
                <div class="row col-xs-12 answers-box">
                    <div class="answers-area">
                        @foreach($identifyCharacterQuiz->answers as $answer)
                            <div class="answer answer-1" id="answer-1">
                                <div class="col-xs-6 margin-bottom">
                                    <label class="answer-label">Answer 1</label>
                                    <div class="col-xs-12 no-padding">
                                        <div class="col-xs-10 no-padding">
                                            <input class="form-control" type="text" placeholder="Enter answer"
                                                   name="answer"
                                                   value="{{ $answer->text }}">
                                        </div>
                                        <div class="col-xs-1 col-xs-offset-1 no-padding checkbox pull-right">
                                            <input type="checkbox" name="correct" @php
                                                if ($answer->correct) {
                                         echo "checked";
                                         } @endphp><i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-xs-12">
                        <a class="btn btn-info btn-quirk" id="add-answer-char">
                            <i class="fa fa-plus-circle"></i> Add answer
                        </a>
                        <a class="btn btn-warning btn-quirk" id="remove-answer-char">
                            <i class="fa fa-minus-circle"></i> Remove answer
                        </a>
                    </div>
                    <hr class="col-xs-12">
                </div>

                <h3 class="col-xs-12">Hints</h3>
                <div class="row col-xs-12">
                    <div class="hint-area">
                        @foreach($identifyCharacterQuiz->identifyCharacterHints as $hint)
                            <div class="hint" id="hint-1">
                                <div class="col-xs-12 margin-bottom">
                                    <div class="col-xs-12 no-padding">
                                        <div class="col-xs-8 no-padding">
                                            <label class="hint-label">Hint 1</label>
                                            <input class="form-control" type="text" placeholder="Enter hint"
                                                   name="hint"
                                                   value="{{ $hint->text }}">
                                        </div>
                                        <div class="col-xs-3 col-xs-offset-1 no-padding">
                                        <span href="#" data-toggle="tooltip"
                                              title="Time to display hint in seconds">
                                            <label class="answer-label">Time to display <i
                                                        class="fa fa-question-circle"></i> </label></span>
                                            <input class="form-control" type="number"
                                                   placeholder="Enter time to display (sec.)"
                                                   name="time" min="5"
                                                   value="{{ $hint->time_to_answer }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-xs-12">
                        <a class="btn btn-info btn-quirk" id="add-hint">
                            <i class="fa fa-plus-circle"></i> Add hint
                        </a>
                        <a class="btn btn-warning btn-quirk" id="remove-hint">
                            <i class="fa fa-minus-circle"></i> Remove hint
                        </a>
                    </div>
                    <hr class="col-xs-12">
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

