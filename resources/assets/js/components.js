// Admin
Vue.component("dashboard", require("./components/admin/Dashboard.vue"));
Vue.component("order", require("./components/admin/Order.vue"));
Vue.component("order-all", require("./components/admin/OrderAll.vue"));
Vue.component("order-delivered", require("./components/admin/OrderDelivered.vue"));
Vue.component("order-pending", require("./components/admin/OrderPending.vue"));
Vue.component("admin-blogs", require("./components/admin/AdminBlog.vue"));

// User
Vue.component("login", require("./components/user/Login.vue"));
Vue.component("register", require("./components/user/Register.vue"));
Vue.component("avatar", require("./components/user/Avatar.vue"));

// Emotion
Vue.component("emotion", require("./components/emotions/Emotion.vue"));

// Comment
Vue.component("comment", require("./components/blog/Comment.vue"));
Vue.component("comment-textarea", require("./components/blog/CommentTextarea.vue"));

// Chat
Vue.component("chat-box", require("./components/chat/Chatbox.vue"));
Vue.component("chat-messages", require("./components/chat/Message.vue"));
Vue.component("chat-form", require("./components/chat/Form.vue"));
Vue.component("chat-userlists", require("./components/chat/Users.vue"));

// Chart
Vue.component("user-chart", require("./components/admin/chart/UserChart"));

// Modal
// Vue.component("modal", require("./components/modal/ModalBox.vue"));

// Gravatar
import Gravatar from "vue-gravatar";
Vue.component("v-gravatar", Gravatar);