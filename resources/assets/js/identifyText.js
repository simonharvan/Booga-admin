/**
 * Created by simonharvan on 25.5.17.
 */
import * as $ from "jquery";

$(document).ready(function () {


    $('.incorrect-text').on('input', function () {

        let text = $('.incorrect-text').val();
        let words = text
            .trim()
            .replace(/\./g, ' .')
            .replace(/\?/g, ' ?')
            .replace(/\!/g, ' !')
            .replace(/\,/g, ' ,')
            .replace(/\"/g, ' " ')
            .replace(/ +(?= )/g,'')
            .split(" ");

        let result = [];

        $('.incorrect-words').empty();

        // generate words with ids to change their future css
        words.forEach(function (item, i) {
            let word = $('<span />').attr({'id': 'word' + i}).html(" " + item);
            word.css('cursor', 'pointer');
            word.css('color','black');
            word.addClass('unselected');

            $('.incorrect-words').append(word);

            $('#word'+i).click(function() {
                if($(this).hasClass('unselected')){
                    $(this).addClass('selected');
                    $(this).removeClass('unselected');
                    $(this).css('color','red');
                }else{
                    $(this).css('color','black');
                    $(this).removeClass('selected');
                    $(this).addClass('unselected');
                }
            });
        });
    });

    $('.store-identify-text').submit(function (e) {
        let result = $('.incorrect-words').find('span.unselected');

        let words = [];
        result.each((i, item) => {
            words.push($(item).attr('id'));
        });

        $('#correct-words').val(words.join(','));
    })


});