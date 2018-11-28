
window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

import Vue from "vue";
import VeeValidate from "vee-validate";
import { Validator } from "vee-validate";

// create rules
Validator.extend('password', {
    getMessage: field => 'The password must contain at least: uppercase letter, 1 lowercase letter, 1 number, and one special character (E.g. , . _ & ? etc)',
    validate: value => {
        var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        return regex.test(value);
    }
});

// custom message
// const dict = {
//     custom: {
//         email: {
       
//         }
//     }
// }

// Validator.localize("en", dict);

Vue.use(VeeValidate);

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER, 
    encrypted: true
});
    
require('./echo');

require('./components');