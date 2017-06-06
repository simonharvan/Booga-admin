window.$ = window.jQuery = require("jquery");
require('./vendor/quirk');
require('bootstrap');


require('./mainView');
require('./books');
require('./libraries');
require('./identifyText');
require('./miniQuiz');
require('./identifyCharacter');
require('./badges');

window.App = {};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});