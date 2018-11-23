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

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
require('../images/homeImages/coffeBackGround.jpg');
