/**
 * Created by simonharvan on 29.5.17.
 */


import * as $ from "jquery";

$(document).ready(function () {


    $('input[name=search]').autocomplete({
        source: function (request, response) {
            $.ajax({
                method: 'GET',
                url: '/search/' + $('#libraries').val() + '/' + $('input[name=search]').val(),
                dataType: "json",
                success: function (data) {
                    response(data['result']);
                },
                fail: function (data) {
                    alert('Failed connection');
                }
            });
        },
        create: function () {
            $(this).data('ui-autocomplete')._renderItem = function (ul, json) {
                let result;

                if (json['note'] != null){
                    result = $('<li>').append('<strong>' + json['title'] + '</strong> (' + json['year_published'] + ') '+ json['author'] +'<br><i>' + json['note'] + '</i>')
                    .appendTo(ul);
                }else {
                    result = $('<li>')
                        .append('<strong>' + json['title'] + '</strong><br><i>' + json['year_published'] + '</i>')
                        .appendTo(ul);
                }
                return result;
            };
        },
        minLength: 3,
        select: function (event, item) {
            loadItem(item);

        }
    });

    $('#load-cover').click(function () {
        loadImage($('input[name=isbn]').val());
    })
});

function loadImage(isbn){
    isbn = isbn.replace(/\D/g,'');
    $('.cover-image').attr('src', 'http://cache2.obalkyknih.cz/api/cover?multi={%22isbn%22:%22' + isbn + '%22}&testenv=XcDf2FvUP');
    $('input[name=cover_photo_url]').val('http://cache2.obalkyknih.cz/api/cover?multi={%22isbn%22:%22' + isbn + '%22}&testenv=XcDf2FvUP');
}

function loadItem(json){
    let item = json['item'];
    if (item['title'] != null){
        let name = $('input[name=name]');
        name.val(item['title']);
        name.focus();
    }
    if (item['isbn'] != null){

        let isbn = $('input[name=isbn]');
        isbn.val(item['isbn']);
        isbn.focus();
        loadImage(item['isbn']);
    }
    if (item['author'] != null){
        let author = $('input[name=author]')
        author.val(item['author']);
        author.focus();
    }
    if (item['year_published'] != null){
        let year = $('input[name=year_published]')
        year.val(item['year_published']);
        year.focus();
    }

    $('input[name=search]').val('');
}