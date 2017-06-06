<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 25.5.17
 * Time: 16:43
 */

namespace App\Http\Controllers\Admin\Books\MiniQuiz;


use App\Http\Controllers\Admin\AdminBadges\AdminBadgesController;
use App\Http\Controllers\Admin\AdminLogsHelper;
use App\Http\Controllers\Admin\Controller;
use App\Models\Book\BookType;
use App\Models\Core\AdminLogType;
use App\Models\Core\HelperAnswer;
use App\Models\MiniQuiz\MiniQuiz;
use App\Models\MiniQuiz\MiniQuizQuestion;
use Illuminate\Http\Request;

class MiniQuizController extends Controller
{
    public function create($id) {
        $book = BookType::find($id);
        return view('pages.mini_quiz.create', [
            'book' => $book,
        ]);
    }

    public function store($id, Request $request) {
        $miniQuiz = new MiniQuiz();

        $data = json_decode($request->json,true);
        $miniQuiz->energy_loss = $data['energy_loss'];
        $miniQuiz->bonus_points = $data['points'];
        $miniQuiz->unlock_rate = $data['unlock'];
        $miniQuiz->save();

        $book = BookType::find($id);
        $book->miniQuiz()->associate($miniQuiz);
        $book->save();

        foreach ($data['questions'] as $question) {
            $miniQuizQuestion = new MiniQuizQuestion();
            $miniQuizQuestion->question = $question['question'];
            $miniQuizQuestion->time_to_answer = $question['time_to_answer'];
            $miniQuizQuestion->points_to_obtain = $question['points_to_obtain'];
            $answers = [];
            $correct = [];
            $i = 0;
            foreach ($question['answers'] as $answer) {
                array_push($answers, $answer['answer']);
                if ($answer['correct'] === true) {
                    array_push($correct, $i);
                }
                $i++;
            }
            $miniQuizQuestion->answers = implode(HelperAnswer::DELIMITER,$answers);
            $miniQuizQuestion->correct_answers = implode(HelperAnswer::DELIMITER,$correct);


            $miniQuizQuestion->miniQuiz()->associate($miniQuiz);
            $miniQuizQuestion->save();
        }

        AdminLogsHelper::log(AdminLogType::MINI_QUIZ_CREATED, auth()->user());

        return AdminBadgesController::checkForNewBadges('admin.books.edit','',[
            'id' => $id,
        ]);
    }

    public function edit($id, $quizId) {
        $book = BookType::find($id);
        $miniQuiz = MiniQuiz::with(['miniQuizQuestions'])->find($quizId);

        foreach ($miniQuiz->miniQuizQuestions as $question) {
            $question->answers = HelperAnswer::decode($question->correct_answers, $question->answers);
        }

        return view('pages.mini_quiz.edit', [
            'book' => $book,
            'miniQuiz' => $miniQuiz,
        ]);
    }

    public function update($id, $quizId, Request $request) {
        $miniQuiz = MiniQuiz::find($quizId);

        $data = json_decode($request->json,true);
        $miniQuiz->energy_loss = $data['energy_loss'];
        $miniQuiz->bonus_points = $data['points'];
        $miniQuiz->unlock_rate = $data['unlock'];
        $miniQuiz->save();

        $miniQuiz->miniQuizQuestions()->delete();

        $book = BookType::find($id);
        $book->miniQuiz()->associate($miniQuiz);
        $book->state = BookType::IN_PROGRESS;
        $book->save();

        foreach ($data['questions'] as $question) {
            $miniQuizQuestion = new MiniQuizQuestion();
            $miniQuizQuestion->question = $question['question'];
            $miniQuizQuestion->time_to_answer = $question['time_to_answer'];
            $miniQuizQuestion->points_to_obtain = $question['points_to_obtain'];
            $answers = [];
            $correct = [];
            $i = 0;
            foreach ($question['answers'] as $answer) {
                array_push($answers, $answer['answer']);
                if ($answer['correct'] === true) {
                    array_push($correct, $i);
                }
                $i++;
            }
            $miniQuizQuestion->answers = implode('*:*',$answers);
            $miniQuizQuestion->correct_answers = implode('*:*',$correct);


            $miniQuizQuestion->miniQuiz()->associate($miniQuiz);
            $miniQuizQuestion->save();
        }

        return redirect(route('admin.books.edit', [
            'id' => $id,
        ]));
    }

    public function destroy($id, $quizId) {
        $book = BookType::find($id);
        $book->mini_quiz_id = null;
        $book->save();

        $miniQuiz = MiniQuiz::find($quizId);
        $miniQuiz->miniQuizQuestions()->delete();
        $miniQuiz->delete();

        return redirect(route('admin.books.edit', [
            'id' => $id,
        ]));
    }
}