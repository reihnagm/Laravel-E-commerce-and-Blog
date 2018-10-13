require('./bootstrap');

require('intl-tel-input');

require('slick-carousel');

window.toastr = require('toastr');

// emotions
Vue.component('emotion', require('./components/emotions/Emotion.vue'));

// Polls
Vue.component('vote', require('./components/poll/Index.vue'));

// chat
Vue.component('chat-box', require('./components/chat/Chatbox.vue'));
Vue.component('chat-messages', require('./components/chat/Message.vue'));
Vue.component('chat-form', require('./components/chat/Form.vue'));
Vue.component('chat-userlists', require('./components/chat/Users.vue'));

const app = new Vue({
    el: '#app'
});
