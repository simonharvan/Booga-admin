/**
 * Created by simonharvan on 26.5.17.
 */


import * as $ from "jquery";


$(document).ready(function () {
    let answer = $('.answer-1').html();
    let counter = 2;
    let max_fields = 20;

    let answersArea = $('.answers-area');

    $('#add-answer-char').click(function (e) {
        e.preventDefault();
        if (counter < max_fields) { //max input box allowed
            counter++; //text box increment
            answersArea.append('<div class="answer" id="answer-' + counter + '">' + answer + '</div>');
            let tempAnswer = $('#answer-' + counter);
            tempAnswer.find('.answer-label').html('Answer ' + counter);
        }

    });

    $('#remove-answer-char').click(function (e) {
        e.preventDefault();
        if (counter > 1) { //max input box allowed
            //text box increment
            answersArea.find('#answer-' + counter).fadeOut(300, function () {
                $(this).remove();
            });
            counter--;
        }

    });

    let hint = $('.hint').html();
    let counterHints = 1;
    let max_hints = 20;
    let hintsArea = $('.hint-area');

    $('#add-hint').click(function (e) {
        e.preventDefault();
        if (counterHints < max_hints) { //max input box allowed
            counterHints++; //text box increment
            hintsArea.append('<div class="hint" id="hint-' + counterHints + '">' + hint + '</div>');
            let tempHint = $('#hint-' + counterHints);
            tempHint.find('.hint-label').html('Hint ' + counterHints);
        }

    });

    $('#remove-hint').click(function (e) {
        e.preventDefault();
        if (counterHints > 0) { //max input box allowed
            //text box increment
            hintsArea.find('#hint-' + counterHints).fadeOut(300, function () {
                $(this).remove();
            });
            counterHints--;
        }

    });

    $('.store-identify-character-quiz').submit(function (e) {
        let charQuiz = {};

        charQuiz['points'] = $('input[name=points]').val();
        charQuiz['unlock'] = $('input[name=unlock]').val();

        let answerArray = [];

        answersArea.find('.answer').each(function (item, index) {
            let answerJson = {};
            answerJson['answer'] = $(this).find('input[name=answer]').val();
            answerJson['correct'] = $(this).find('input[name=correct]').prop('checked');
            answerArray.push(answerJson);
        });

        let hintsArray = [];

        hintsArea.find('.hint').each(function (item, index) {
            let hintJson = {};
            hintJson['hint'] = $(this).find('input[name=hint]').val();
            hintJson['time'] = $(this).find('input[name=time]').val();
            hintsArray.push(hintJson);
        });

        charQuiz['answers'] = answerArray;
        charQuiz['hints'] = hintsArray;

        $('#json').val(JSON.stringify(charQuiz));
    })


});

