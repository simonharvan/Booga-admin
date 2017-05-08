window.$ = window.jQuery = require("jquery");
require('./vendor/quirk');
require('bootstrap');


require('./mainView');
require('./libraries');

window.App = {};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});