<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 29.5.17
 * Time: 16:12
 */

namespace App\Http\Controllers\Admin\Books\IdentifyCharacter;


use App\Http\Controllers\Admin\AdminBadges\AdminBadgesController;
use App\Http\Controllers\Admin\AdminLogsHelper;
use App\Http\Controllers\Admin\Controller;
use App\Models\Book\BookType;
use App\Models\Core\AdminLogType;
use App\Models\IdentifyCharacter\IdentifyCharacterHint;
use App\Models\IdentifyCharacter\IdentifyCharacterQuiz;

use App\Models\Core\HelperAnswer;
use Illuminate\Http\Request;


class IdentifyCharacterQuizController extends Controller
{
    public function create($id)
    {
        $book = BookType::find($id);
        return view('pages.identify_character.create', [
            'book' => $book,
        ]);
    }

    public function store($id, Request $request)
    {
        $identifyCharacterQuiz = new IdentifyCharacterQuiz();

        $data = json_decode($request->json, true);
        $identifyCharacterQuiz->max_points_obtain = $data['points'];
        $identifyCharacterQuiz->unlock_rate = $data['unlock'];


        $answers = [];
        $correct = [];
        $i = 0;

        foreach ($data['answers'] as $answer) {
            array_push($answers, $answer['answer']);
            if ($answer['correct'] === true) {
                array_push($correct, $i);
            }
            $i++;
        }

        $identifyCharacterQuiz->answers = implode('*:*', $answers);
        $identifyCharacterQuiz->correct_answers = implode('*:*', $correct);

        $identifyCharacterQuiz->save();

        $book = BookType::find($id);
        $book->identifyCharacterQuiz()->associate($identifyCharacterQuiz);
        $book->save();

        foreach ($data['hints'] as $hint) {
            $identifyCharacterHint = new IdentifyCharacterHint();
            $identifyCharacterHint->text = $hint['hint'];
            $identifyCharacterHint->time_to_answer = $hint['time'];

            $identifyCharacterHint->identifyCharacterQuiz()->associate($identifyCharacterQuiz);
            $identifyCharacterHint->save();
        }

        AdminLogsHelper::log(AdminLogType::IDENTIFY_CHARACTER_QUIZ_CREATED, auth()->user());

        return AdminBadgesController::checkForNewBadges('admin.books.edit','',[
            'id' => $id,
        ]);
    }

    public function edit($id, $quizId)
    {
        $book = BookType::find($id);
        $identifyCharacterQuiz = IdentifyCharacterQuiz::with(['identifyCharacterHints'])->find($quizId);

        $identifyCharacterQuiz->answers = HelperAnswer::decode($identifyCharacterQuiz->correct_answers, $identifyCharacterQuiz->answers);


        return view('pages.identify_character.edit', ['book' => $book,
            'identifyCharacterQuiz' => $identifyCharacterQuiz,]);
    }

    public function update($id, $quizId, Request $request) {
        $identifyCharacterQuiz = IdentifyCharacterQuiz::find($quizId);

        $data = json_decode($request->json, true);
        $identifyCharacterQuiz->max_points_obtain = $data['points'];
        $identifyCharacterQuiz->unlock_rate = $data['unlock'];


        $answers = [];
        $correct = [];
        $i = 0;

        foreach ($data['answers'] as $answer) {
            array_push($answers, $answer['answer']);
            if ($answer['correct'] === true) {
                array_push($correct, $i);
            }
            $i++;
        }

        $identifyCharacterQuiz->answers = implode('*:*', $answers);
        $identifyCharacterQuiz->correct_answers = implode('*:*', $correct);
        $identifyCharacterQuiz->identifyCharacterHints()->delete();
        $identifyCharacterQuiz->save();

        $book = BookType::find($id);
        $book->identifyCharacterQuiz()->associate($identifyCharacterQuiz);
        $book->state = BookType::IN_PROGRESS;
        $book->save();

        foreach ($data['hints'] as $hint) {
            $identifyCharacterHint = new IdentifyCharacterHint();
            $identifyCharacterHint->text = $hint['hint'];
            $identifyCharacterHint->time_to_answer = $hint['time'];

            $identifyCharacterHint->identifyCharacterQuiz()->associate($identifyCharacterQuiz);
            $identifyCharacterHint->save();
        }

        return redirect(route('admin.books.edit', [
            'id' => $id,
        ]));
    }

    public function destroy($id, $quizId) {
        $book = BookType::find($id);
        $book->identify_character_quiz_id = null;
        $book->save();

        $identifyCharacterQuiz = IdentifyCharacterQuiz::find($quizId);
        $identifyCharacterQuiz->identifyCharacterHints()->delete();
        $identifyCharacterQuiz->delete();

        return redirect(route('admin.books.edit', [
            'id' => $id,
        ]));
    }
}