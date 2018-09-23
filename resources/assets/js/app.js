require('./bootstrap');

window.Vue = require('vue');

window.toastr = require('toastr');

window.numeral = require('numeral');

Vue.use(wysiwyg, {});
Vue.use(VueRouter)

require('intl-tel-input');

require('slick-carousel');

require('webpack-jquery-ui');

require('webpack-jquery-ui/css');

require('animate.css');

import wysiwyg from "vue-wysiwyg";
import VueRouter from 'vue-router'

export const bus = new Vue()

Vue.component('createblog', require('./components/CreateBlog.vue'));
Vue.component('blog', require('./components/Blog.vue'));
Vue.component('emotion', require('./components/Emotion.vue'));
// Vue.component('comment', require('./components/Comment.vue'));
Vue.component('comment', require('./components/CommentBox.vue'));
Vue.component('commenttextarea', require('./components/TextareaCommentBox.vue'));
Vue.component('like', require('./components/Like.vue'));

const vm = new Vue({
    el: '#app',
    data() {
     return {
        comments: [],
        emotions: []
      }
    },
    mounted() {
      this.getComment()
      this.getEmotion()
    },
    methods: {
    getComment() {
      axios.get('/api/blog-comment').then((res) => {
        this.comments = res.data.data
        console.log(res.data.data)
      }).catch((err) => {
        console.log(err)
      })
    },
    getEmotion() {
      axios.get('/emotion').then((res) => {
        this.emotions = res.data
      }).catch((err) => {
        console.log(err)
      })
    }
  }
});
