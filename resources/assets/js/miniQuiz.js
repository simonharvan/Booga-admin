/**
 * Created by simonharvan on 26.5.17.
 */


import * as $ from "jquery";


$(document).ready(function () {
    let questionRef = $('.question-box');
    let question = questionRef.html();
    let answer = $('.answer').html();
    let counter = 1;
    let max_fields = 20;

    let questionsArea = $('.questions-area');

    questionRef.attr('id', 'question-1');
    questionRef.find('.label-question').html('Question ' + counter);
    questionRef.find('a#add-answer').click(function (e) {
        let id = $(this).parent().parent().attr('id');
        questionsArea.find('#' + id).find('.answer-area').append('<div class="answer">' + answer + '</div>');
    });
    questionRef.find('a#remove-answer').click(function (e) {

        let id = $(this).parent().parent().attr('id');
        let answers = questionsArea.find('#' + id).find('.answer');
        if (answers.length > 2) {
            answers[answers.length - 1].remove();
        }
    });

    $('#add-question').click(function (e) {
        e.preventDefault();
        if (counter < max_fields) { //max input box allowed
            counter++; //text box increment
            questionsArea.append('<div class="row col-xs-12 question-box" id="question-' + counter + '">' + question + '</div>');
            let tempQuestion = $('#question-' + counter);
            tempQuestion.find('.label-question').html('Question ' + counter);

            tempQuestion.find('a#add-answer').click(function (e) {
                let id = $(this).parent().parent().attr('id');
                questionsArea.find('#' + id).find('.answer-area').append('<div class="answer">' + answer + '</div>');
            });
            tempQuestion.find('a#remove-answer').click(function (e) {

                let id = $(this).parent().parent().attr('id');
                let answers = questionsArea.find('#' + id).find('.answer');
                if (answers.length > 2) {
                    answers[answers.length - 1].remove();
                }
            });
        }

    });

    $('#remove-question').click(function (e) {
        e.preventDefault();
        if (counter > 1) { //max input box allowed
            //text box increment
            questionsArea.find('#question-' + counter).fadeOut(300, function () {
                $(this).remove();
            });
            counter--;
        }

    });

    $('.store-mini-quiz').submit(function (e) {
        if (counter < 8) {
            alert("You have to enter minimum 8 questions");
            return false;
        }

        let miniQuiz = {};

        miniQuiz['energy_loss'] = $('input[name=energy_loss]').val();
        miniQuiz['points'] = $('input[name=points]').val();
        miniQuiz['unlock'] = $('input[name=unlock]').val();

        let questionArray = [];

        questionsArea.find('.question-box').each(function (item, index) {
            let questionJson = {};
            questionJson['question'] = $(this).find('input[name=question]').val();
            questionJson['time_to_answer'] = $(this).find('input[name=time_to_answer]').val();
            questionJson['points_to_obtain'] = $(this).find('input[name=points_to_obtain]').val();

            let answerArray = [];

            $(this).find('.answer').each(function (item, index) {
                let answerJson = {};
                answerJson['answer'] = $(this).find('input[name=answer]').val();
                answerJson['correct'] = $(this).find('input[name=correct]').prop('checked');
                answerArray.push(answerJson);
            });

            questionJson['answers'] = answerArray;
            questionArray.push(questionJson);
        });

        miniQuiz['questions'] = questionArray;

        $('#json').val(JSON.stringify(miniQuiz));
    })


});

