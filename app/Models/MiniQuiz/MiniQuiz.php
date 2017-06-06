<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 25.5.17
 * Time: 16:44
 */

namespace App\Models\MiniQuiz;


use App\Models\Book\BookType;
use Illuminate\Database\Eloquent\Model;

class MiniQuiz extends Model
{
    protected $table = 'Mini_quiz';

    public function miniQuizQuestions() {
        return $this->hasMany(MiniQuizQuestion::class);
    }

    public function book() {
        return $this->hasOne(BookType::class);
    }
}