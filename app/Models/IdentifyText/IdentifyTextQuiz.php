<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 24.5.17
 * Time: 22:26
 */

namespace App\Models\IdentifyText;


use App\Models\Book\BookType;
use Illuminate\Database\Eloquent\Model;

class IdentifyTextQuiz extends Model
{
    protected $table = "Identify_text_quiz";

    public function book(){
        return $this->hasOne(BookType::class);
    }
}