@extends('layout.authenticated')


@section('breadcrumbs')
    <h1>
        Quizzes
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quizzes</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">

            <h2>Identify text quiz</h2>
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
                @foreach($identifyTextQuizzes as $identifyTextQuiz)
                    <tr>
                        <td>{{ $identifyTextQuiz->id }}</td>
                        <td>{{ $identifyTextQuiz->correct_quiz }}</td>
                        <td>{{ $identifyTextQuiz->incorrect_quiz }}</td>
                        <td>{{ $identifyTextQuiz->energy_loss }}</td>
                        <td>{{ $identifyTextQuiz->points_to_obtain_for_word}}</td>
                        <td>{{ $identifyTextQuiz->created_at}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $identifyTextQuizzes->links() }}
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <h2>Identify character quiz</h2>
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
                @foreach($identifyCharacterQuizzes as $identifyCharacterQuiz)
                    <tr>
                        <td>{{ $identifyCharacterQuiz->id }}</td>
                        <td>{{ $identifyCharacterQuiz->answers }}</td>
                        <td>{{ $identifyCharacterQuiz->correct_answers }}</td>
                        <td>{{ $identifyCharacterQuiz->max_points_obtain }}</td>
                        <td>{{ $identifyCharacterQuiz->unlock_rate}}</td>
                        <td>{{ $identifyCharacterQuiz->created_at}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $identifyCharacterQuizzes->links() }}
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <h2>Mini quiz</h2>
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
                @foreach($miniQuizzes as $miniQuiz)
                    <tr>
                        <td>{{ $miniQuiz->id }}</td>
                        <td>{{ $miniQuiz->bonus_points }}</td>
                        <td>{{ $miniQuiz->energy_loss }}</td>
                        <td>{{ $miniQuiz->unlock_rate}}</td>
                        <td>{{ $miniQuiz->created_at}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $miniQuizzes->links() }}
            </div>
        </div>
    </div>


@endsection