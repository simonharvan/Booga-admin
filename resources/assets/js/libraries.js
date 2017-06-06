/**
 * Created by simonharvan on 4.4.17.
 */

import * as $ from "jquery";
$( document ).ready(function() {

    $( "#test-library" ).click(function( event ) {

        var formData = {
            url: $('input[name=url]').val(),
            port: $('input[name=port]').val(),
            database: $('input[name=database_name]').val(),
        };

        $.ajax({
            method: 'POST',
            url: '/test',
            data: formData,
            success: function(data) {
                alert(data);
                console.log("Data test: ", data);
            },
            error: function(e) {
                alert(e['responseText']);
                console.error("Error test: ", e);
            },
            dataType: "json",
        });
    });



});