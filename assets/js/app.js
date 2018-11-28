/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
const $ = require('jquery');

require('bootstrap');

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

require('../images/teaImages/presentation_tea.jpg');
require('../images/coffeeImages/coffee_beans.jpg');



