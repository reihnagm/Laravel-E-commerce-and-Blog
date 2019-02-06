// User
Vue.component("login", require("./components/user/Login.vue"));
Vue.component("register", require("./components/user/Register.vue"));
Vue.component("avatar", require("./components/user/Avatar.vue"));

// Emotion
Vue.component("emotion", require("./components/emotions/Emotion.vue"));

// Comment
Vue.component("comment", require("./components/blog/Comment.vue"));
Vue.component(
  "comment-textarea",
  require("./components/blog/CommentTextarea.vue")
);

// Chat
Vue.component("chat-box", require("./components/chat/Chatbox.vue"));
Vue.component("chat-messages", require("./components/chat/Message.vue"));
Vue.component("chat-form", require("./components/chat/Form.vue"));
Vue.component("chat-userlists", require("./components/chat/Users.vue"));

// Gravatar
import Gravatar from "vue-gravatar";
Vue.component("v-gravatar", Gravatar);