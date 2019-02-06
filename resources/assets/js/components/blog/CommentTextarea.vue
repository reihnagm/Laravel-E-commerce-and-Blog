<template>
<div>
  <div class="wrapper-textarea-comment">
    <textarea placeholder="test" class="textarea-comment" v-model="subject"></textarea>
    <a class="button-comment" href="#!" @click.prevent="sentComment()">Comment</a>
  </div>
</div>
</template>

<script>
import Bus from "../../bus";
export default {
  props: ["blog_id", "user_id"],
  data() {
    return {
      comment_id: 0,
      subject: "",
      likes_count: 0,
      unlikes_count: 0
    };
  },
  methods: {
    sentComment() {
      let data = {
        subject: this.subject,
        likes_count: this.likes_count,
        unlikes_count: this.unlikes_count,
        user: {
          username: Laravel.user.username
        }
      };
      axios
        .post("/api/blog-comment/" + this.blog_id + "/" + this.user_id, {
          subject: this.subject
        })
        .then(response => {
          Bus.$emit("comment.sent", data);
          this.subject = "";
        });
    }
  }
};
</script>

<style scoped>
.wrapper-textarea-comment {
  display: flex;
  padding: 5px;
  align-items: center;
  margin-right: 8px;
}

.textarea-comment {
  padding: 8px;
  color: rgba(37, 37, 37, 0.5);
  resize: none;
  overflow-y: scroll;
}

.textarea-comment:focus {
  outline: none;
}

.button-comment {
  display: block;
  text-align: center;
  margin-left: 8px;
  padding: 8px;
  border: 0.5px solid rgba(37, 37, 37, 0.5);
  color: rgba(37, 37, 37, 0.5);
}
</style>
