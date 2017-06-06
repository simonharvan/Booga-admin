<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 24.5.17
 * Time: 22:20
 */

namespace App\Http\Controllers\Admin\Quizzes;


use App\Http\Controllers\Admin\Controller;
use App\Models\IdentifyCharacter\IdentifyCharacterQuiz;
use App\Models\IdentifyText\IdentifyTextQuiz;
use App\Models\MiniQuiz\MiniQuiz;

class QuizzesController extends Controller
{
    /**
     *
     */
    public function index() {

        $identifyTextQuizzes = IdentifyTextQuiz::paginate(10);

        $miniQuizzes = MiniQuiz::paginate(10);

        $identifyCharacterQuizzes = IdentifyCharacterQuiz::paginate(10);

        return view('pages.quizzes.index', [
            'identifyTextQuizzes' => $identifyTextQuizzes,
            'miniQuizzes' => $miniQuizzes,
            'identifyCharacterQuizzes' => $identifyCharacterQuizzes,
        ]);
    }
}