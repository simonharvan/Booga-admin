<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 28.5.17
 * Time: 16:04
 */

namespace App\Models\Core;


class HelperAnswer
{
    public $text = "";
    public $correct = false;

    const DELIMITER = "*:*";


    public static function decode($input_correct_answers, $input_answers) {
        $answersParsed = [];
        $corrects = explode( HelperAnswer::DELIMITER, $input_correct_answers);
        $answers = explode(HelperAnswer::DELIMITER, $input_answers);
        for ($i = 0; $i < count($answers); $i++) {
            $answer = new HelperAnswer();
            $answer->text = $answers[$i];
            $correct = false;
            foreach ($corrects as $c) {
                if ($i == $c) {
                    $correct = true;
                }
            }
            $answer->correct = $correct;
            array_push($answersParsed, $answer);
        }

        return $answersParsed;
    }

}