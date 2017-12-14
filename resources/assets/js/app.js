/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


// Template JS
require("./admin");


// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });


// <!-- Validation Plugin Js -->
require("../plugins/jquery-validation/jquery.validate.js");


// <!-- Select Plugin Js -->
require("../plugins/bootstrap-select/js/bootstrap-select");

// <!-- Slimscroll Plugin Js -->
require('../plugins/jquery-slimscroll/jquery.slimscroll');

// <!-- Jquery CountTo Plugin Js -->
require('../plugins/jquery-countto/jquery.countTo');

// <!-- Morris Plugin Js -->
require('../plugins/morrisjs/morris');

// <!-- ChartJs -->
require('../plugins/chartjs/Chart.bundle');

// <!-- Flot Charts Plugin Js -->
require('../plugins/flot-charts/jquery.flot');
require('../plugins/flot-charts/jquery.flot.resize');
require('../plugins/flot-charts/jquery.flot.pie');

// <!-- Sparkline Chart Plugin Js -->
require('../plugins/jquery-sparkline/jquery.sparkline');

// <!-- Bootstrap Colorpicker Js -->
require('../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker');

// <!-- Dropzone Plugin Js -->
require('../plugins/dropzone/dropzone');

// <!-- Input Mask Plugin Js -->
require('../plugins/jquery-inputmask/jquery.inputmask.bundle');

// <!-- Multi Select Plugin Js -->
require('../plugins/multi-select/js/jquery.multi-select');

// <!-- Jquery Spinner Plugin Js -->
require('../plugins/jquery-spinner/js/jquery.spinner');

// <!-- Bootstrap Tags Input Plugin Js -->
require('../plugins/bootstrap-tagsinput/bootstrap-tagsinput');

// <!-- noUISlider Plugin Js -->
require('../plugins/nouislider/nouislider');

// <!-- Waves Effect Plugin Js -->
require('../plugins/node-waves/waves');

// <!-- Dropzone Plugin Js -->
require('../plugins/dropzone/dropzone');

// demo JS
require("./demo");