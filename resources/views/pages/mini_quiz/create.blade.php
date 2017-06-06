@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.books.edit', ['id' => $book->id]) }}"><i class="fa fa-arrow-circle-left"></i></a>
        Create mini quiz for book: {{ $book->name }}
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.books.index') }}">Books</a></li>
        <li><a href="{{ route('admin.books.edit', ['id' => $book->id]) }}">{{ $book->name }}</a></li>
        <li class="active">Create</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="store-mini-quiz" action="{{ route('admin.miniQuiz.store', [ 'id' => $book->id ]) }}"
                  method="post">
                {{ csrf_field() }}
                <input type="hidden" name="json" id="json">
                <div class="row col-xs-12">
                    <div class="col-xs-4">
                        <label>Energy loss</label>
                        <input class="form-control" type="number" placeholder="Enter energy loss"
                               name="energy_loss"
                               value="{{ old('energy_loss') }}" min="0">
                    </div>

                    <div class="col-xs-4 ">
                        <span href="#" data-toggle="tooltip"
                              title="Bonus points if player does quiz 100%">
                            <label>Bonus points <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter points"
                               name="points"
                               value="{{ old('points') }}" min="0">
                    </div>

                    <div class="col-xs-4">
                        <span href="#" data-toggle="tooltip"
                              title="Number which sets how much points you need for quiz to be successful">
                            <label>Unlock rate <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter unlock rate"
                               name="unlock"
                               value="{{ old('unlock') }}" min="0">
                    </div>
                    <hr class="col-xs-12">
                </div>
                <div class="questions-area">

                    <h3 class="col-xs-12">Questions</h3>
                    <div class="row col-xs-12 question-box">
                        <div class="col-xs-12">
                            <label class="label-question"><strong>Question</strong></label>
                            <input class="form-control" type="text" placeholder="Enter question"
                                   name="question"
                                   value="">
                        </div>
                        <div class="col-xs-6">
                            <label>Points to obtain</label>
                            <input class="form-control" type="number" placeholder="Enter points"
                                   name="points_to_obtain" min="0"
                                   value="">
                        </div>
                        <div class="col-xs-6">
                            <label>Time to answer</label>
                            <input class="form-control" type="number" placeholder="Enter time"
                                   name="time_to_answer" min="0"
                                   value="">
                        </div>

                        <hr class="col-xs-10 col-xs-offset-1">
                        <div class="answer-area">
                            <div class="answer answer-1">
                                <div class="col-xs-6">
                                    <label>Answer</label>
                                    <div class="col-xs-12 no-padding">
                                        <div class="col-xs-10 no-padding">
                                            <input class="form-control" type="text" placeholder="Enter answer"
                                                   name="answer"
                                                   value="">
                                        </div>
                                        <div class="col-xs-1 col-xs-offset-1 no-padding checkbox pull-right">
                                            <input type="checkbox" name="correct"><i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="answer">
                                <div class="col-xs-6 answer-2">
                                    <label>Answer</label>
                                    <div class="col-xs-12 no-padding">
                                        <div class="col-xs-10 no-padding">
                                            <input class="form-control" type="text" placeholder="Enter answer"
                                                   name="answer"
                                                   value="">
                                        </div>
                                        <div class="col-xs-1 col-xs-offset-1 no-padding checkbox pull-right">
                                            <input type="checkbox" name="correct"><i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <a class="btn btn-info btn-quirk" id="add-answer">
                                <i class="fa fa-plus-circle"></i> Add answer
                            </a>
                            <a class="btn btn-warning btn-quirk" id="remove-answer">
                                <i class="fa fa-minus-circle"></i> Remove answer
                            </a>
                        </div>
                        <hr class="col-xs-12">
                    </div>
                </div>
                <div class="col-xs-12">
                    <a class="btn btn-success btn-quirk" id="add-question">
                        <i class="fa fa-plus-circle"></i> Add question
                    </a>
                    <a class="btn btn-danger btn-quirk" id="remove-question">
                        <i class="fa fa-minus-circle"></i> Remove question
                    </a>
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

