<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 25.5.17
 * Time: 11:37
 */

namespace App\Http\Controllers\Admin\Books\IdentifyText;


use App\Http\Controllers\Admin\AdminBadges\AdminBadgesController;
use App\Http\Controllers\Admin\AdminLogsHelper;
use App\Http\Controllers\Admin\Controller;
use App\Models\Book\BookType;
use App\Models\Core\AdminLogType;
use App\Models\IdentifyText\IdentifyTextQuiz;
use Illuminate\Http\Request;

class IdentifyTextQuizController extends Controller
{
    public function create($id) {

        $book = BookType::find($id);

        return view('pages.identify_text.create', [
            'book'=> $book,
        ]);
    }

    public function store($id, Request $request)
    {

        $identifyTextQuiz = new IdentifyTextQuiz();

        $identifyTextQuiz->correct_quiz = $request->correct;
        $identifyTextQuiz->correct_words = $request->correct_words;
        $identifyTextQuiz->incorrect_quiz = $request->incorrect;
        $identifyTextQuiz->energy_loss = $request->energy_loss;
        $identifyTextQuiz->points_to_obtain_for_word = $request->points;
        $identifyTextQuiz->unlock_rate = $request->unlock;
        $identifyTextQuiz->save();


        $book = BookType::find($id);
        $book->identifyTextQuiz()->associate($identifyTextQuiz);
        $book->save();


        AdminLogsHelper::log(AdminLogType::IDENTIFY_TEXT_QUIZ_CREATED, auth()->user());

        return AdminBadgesController::checkForNewBadges('admin.books.edit','',[
            'id' => $id,
        ]);
    }

    public function edit($id, $quizId){
        $book = BookType::find($id);

        $identifyTextQuiz = IdentifyTextQuiz::find($quizId);

        return view('pages.identify_text.edit', [
            'book'=> $book,
            'identifyTextQuiz' => $identifyTextQuiz,
        ]);
    }

    public function update($id, $quizId, Request $request){
        $identifyTextQuiz = IdentifyTextQuiz::find($quizId);

        $identifyTextQuiz->correct_quiz = $request->correct;
        $identifyTextQuiz->correct_words = $request->correct_words;
        $identifyTextQuiz->incorrect_quiz = $request->incorrect;
        $identifyTextQuiz->energy_loss = $request->energy_loss;
        $identifyTextQuiz->points_to_obtain_for_word = $request->points;
        $identifyTextQuiz->unlock_rate = $request->unlock;
        $identifyTextQuiz->save();
        return redirect(route('admin.books.edit', [
            'id' => $id,
        ]));
    }

    public function destroy($id, $quizId) {

        $book = BookType::find($id);
        $book->identify_text_quiz_id = null;
        $book->save();

        $identifyTextQuiz = IdentifyTextQuiz::find($quizId);
        $identifyTextQuiz->delete();

        return redirect(route('admin.books.edit', [
            'id' => $id,
        ]));
    }
}