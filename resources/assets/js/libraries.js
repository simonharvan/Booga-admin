/**
 * Created by simonharvan on 4.4.17.
 */

import * as $ from "jquery";
$( document ).ready(function() {

    ajaxOptions: {
        dataType: 'json'
    }

    $( "#test-library" ).click(function( event ) {


        $.ajax({
            method: 'POST',
            contentType: "application/json; charset=utf-8",
            url: '/admin/libraries/test',
            data: { id: 1, name: "Jason" },
            success: function(data) {

                alert('Data: ' + data);
            },
            error: function(e) {
                alert('Error: ' + e);
            },
            dataType: "json",
        });
    });



});