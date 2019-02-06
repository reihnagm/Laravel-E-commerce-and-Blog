window._ = require("lodash");

window.$ = window.jQuery = require("jquery");

window.Vue = require("vue");

window.axios = require("axios");

window.numeral = require('numeral');

window.axios.defaults.headers.common = {
  "X-CSRF-TOKEN": window.Laravel.csrfToken,
  "X-Requested-With": "XMLHttpRequest"
};

import Vue from "vue";
import VeeValidate from "vee-validate";
import { Validator } from "vee-validate";
import Echo from "laravel-echo";

Validator.extend("name", {
  getMessage: field =>
    "The name field is required.",
  validate: value => !! value
}); 

Validator.extend("password", {
  getMessage: field =>
    "The password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number, and one special character (hint : SUper&&4)",
  validate: value => {
    var regexp = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/;
    return regexp.test(value);
  }
}); 

Vue.use(VeeValidate);

window.Pusher = require("pusher-js");

window.Echo = new Echo({
  broadcaster: "pusher",
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  encrypted: true
});

require("./echo");

require("./components");
