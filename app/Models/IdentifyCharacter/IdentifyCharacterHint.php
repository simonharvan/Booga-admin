<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 29.5.17
 * Time: 16:10
 */

namespace App\Models\IdentifyCharacter;


use Illuminate\Database\Eloquent\Model;

class IdentifyCharacterHint extends Model
{
    protected $table = "Identify_character_quiz_hint";

    public function identifyCharacterQuiz() {
        return $this->belongsTo(IdentifyCharacterQuiz::class);
    }
}