<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 25.5.17
 * Time: 16:45
 */

namespace App\Models\MiniQuiz;


use Illuminate\Database\Eloquent\Model;

class MiniQuizQuestion extends Model
{
    protected $table = 'Mini_quiz_question';

    public function miniQuiz() {
        return $this->belongsTo(MiniQuiz::class);
    }
}