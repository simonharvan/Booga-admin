<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 24.5.17
 * Time: 22:26
 */

namespace App\Models\IdentifyCharacter;


use App\Models\Book\BookType;
use Illuminate\Database\Eloquent\Model;

class IdentifyCharacterQuiz extends Model
{
    protected $table = "Identify_character_quiz";

    public function book(){
        return $this->hasOne(BookType::class);
    }

    public function identifyCharacterHints() {
        return $this->hasMany(IdentifyCharacterHint::class);
    }
}