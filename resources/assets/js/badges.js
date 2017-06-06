/**
 * Created by simonharvan on 5.6.17.
 */


import * as $ from "jquery";

$(document).ready(function () {
    let condtionRef = $('.condition');
    let condition = condtionRef.html();
    let conditionArea = $('.conditions-area');
    let counter = 1;

    condtionRef.find('.condition-name').html('Condition 1');

    $('#add-condition').click(function () {
        counter++;
        conditionArea.append('<div class="condition" id="condition-'+ counter +'">'+ condition +'</div>');

        let tempCond = $('#condition-' + counter);
        tempCond.find('.condition-name').html('Condition ' + counter);
    });

    $('#remove-condition').click(function () {
        if (counter > 1) { //max input box allowed
            //text box increment
            conditionArea.find('#condition-' + counter).fadeOut(300, function () {
                $(this).remove();
            });
            counter--;
        }
    });

    $('#store-badge').submit(function (e) {

        let badge = {};

        badge['name'] = $('input[name=name]').val();
        badge['description'] = $('input[name=description]').val();

        let conditionsArray = [];

        conditionArea.find('.condition').each(function (item, index) {
            let conditionJson = {};
            conditionJson['script'] = $(this).find('textarea[name=script]').val();
            conditionJson['event_type'] = $(this).find('#event_type').val();
            conditionJson['operator'] = $(this).find('#operator').val();
            conditionJson['number'] = $(this).find('input[name=number]').val();
            conditionsArray.push(conditionJson);
        });

        badge['conditions'] = conditionsArray;

        $('#json').val(JSON.stringify(badge));

    })
});