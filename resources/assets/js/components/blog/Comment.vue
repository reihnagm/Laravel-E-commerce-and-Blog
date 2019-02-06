<template>
  <div>
    <div class="container-commnent" v-for="comment in comments" :key="comment.id">
      <div class="container-user-comment clearfix">
        <img class="comment-ava" :src="comment.user.avatar">
      </div>
      <span class="comment-username">{{ comment.user.name }}</span>
      <span class="comment-subject">{{ comment.subject }}</span>

      <div class="container-like-unlike">
        <span @click.prevent="like(comment.id)" class="comment-likes"></span>
        {{ comment.likes_count }}
        <span
          @click.prevent="unlike(comment.id)"
          class="comment-unlikes"
        ></span>
        {{ comment.unlikes_count }}
      </div>

      <div v-if="comment.user.id == auth_user_id">
        <div class="container-edit-delete">
          <a href="#!" @click.prevent="showModal(comment)">Edit</a>
          <a href="#!" @click.prevent="deleteComment(comment.id)">Delete</a>
        </div>
      </div>
    </div>

    <div v-if="comments.length">
      <a
        @click.prevent="getComment(pagination.prev_page_url)"
        href="#!"
        v-bind:class="[{disabled: !pagination.prev_page_url}]"
        class="button"
      >Previous comment</a>
      <span>Page {{ pagination.current_page }} of {{ pagination.last_page }} Pages</span>
      <a
        @click.prevent="getComment(pagination.next_page_url)"
        href="#!"
        v-bind:class="[{disabled: !pagination.next_page_url}]"
        class="button"
      >Next comment</a>
    </div>

    <!-- SHOW SINGLE MODAL -->
    <transition name="modal-fade">
      <div v-show="isModalVisible">
        <div class="modal">
          <div class="modal-backdrop">
            <div class="modal-body">
              <button type="button" @click="closeModal">X</button>
              <textarea v-model="modalData.subject"></textarea>
              <a
                href="#!"
                class="button-comment-update"
                @click.prevent="updateComment(modalData.id, modalData.subject)"
              >update comment</a>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <div v-if="auth" class="container-textarea-comment">
      <textarea class="textarea-comment" v-model="subject"></textarea>
      <a href="#!" class="button-comment" @click.prevent="sentComment()">Comment</a>
    </div>
  </div>
</template>

<script>
import Bus from "../../bus";

export default {
  props: ["blog_id"],
  data() {
    return {
      auth: Laravel.auth,
      auth_user_id: Laravel.auth_id,
      isModalVisible: false,
      pagination: {},
      modalData: {},
      subject: "",
      comment: {
        subject: ""
      },
      comments: []
    };
  },
  mounted() {
    this.listen();
    this.getComment();
  },
  methods: {
    showModal(comment) {
      this.isModalVisible = true;
      this.modalData = JSON.parse(JSON.stringify(comment));
    },
    closeModal() {
      this.isModalVisible = false;
    },

    // LIKE AND UNLIKE FEATURE

    like(comment_id) {
      axios
        .get("/like/" + comment_id + "/2")
        .then(response => {
          if (response.data.message == "like") {
            let index = this.comments.findIndex(
              comment => comment.id === comment_id
            );
            this.comments[index].likes_count++;
            this.changedLikeToUnlike(comment_id);
          } else {
            this.cancelLike(comment_id);
            let index = this.comments.findIndex(
              comment => comment.id === comment_id
            );
            this.comments[index].likes_count--;
          }
        })
        .catch(error => {
          if (
            (error.response.data.message =
              "Trying to get property of non-object")
          ) {
            toastr.info("You must Login before!");
          }
          console.log(error.response);
        });
    },
    cancelLike(comment_id) {
      axios.get("/cancel_like/" + comment_id + "/2").then(response => {});
    },
    unlike(comment_id) {
      axios
        .get("/unlike/" + comment_id + "/2")
        .then(response => {
          if (response.data.message == "unlike") {
            let index = this.comments.findIndex(
              comment => comment.id === comment_id
            );
            this.comments[index].unlikes_count++;
            this.changedUnlikeToLike(comment_id);
          } else {
            this.cancelUnlike(comment_id);
            let index = this.comments.findIndex(
              comment => comment.id === comment_id
            );
            this.comments[index].unlikes_count--;
          }
        })
        .catch(error => {
          if (
            (error.response.data.message =
              "Trying to get property of non-object")
          ) {
            toastr.info("You must Login before!");
          }
          console.log(error.response);
        });
    },
    cancelUnlike(comment_id) {
      axios.get("/cancel_unlike/" + comment_id + "/2").then(response => {});
    },
    changedLikeToUnlike(comment_id) {
      axios.get("/cancel_unlike/" + comment_id + "/2").then(response => {});
      let index = this.comments.findIndex(comment => comment.id === comment_id);
      if (this.comments[index].unlikes_count > 0) {
        this.comments[index].unlikes_count--;
      }
    },
    changedUnlikeToLike(comment_id) {
      axios.get("/cancel_like/" + comment_id + "/2").then(response => {});
      let index = this.comments.findIndex(comment => comment.id === comment_id);
      if (this.comments[index].likes_count > 0) {
        this.comments[index].likes_count--;
      }
    },

    // COMMENT FEATURE

    getComment(url) {
      url = url || "/blog_comment/" + this.blog_id;
      axios.get(url).then(response => {
        this.comments = response.data.data;
        this.makePagination(response.data.meta, response.data.links);
      });
    },
    makePagination(meta, links) {
      var pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    async sentComment() {
      await axios
        .post("/blog_comment/" + this.blog_id + "/" + this.auth_user_id, {
          subject: this.subject
        })
        .catch(error => {
          console.log(error.response);
        });
      this.$nextTick().then(response => {
        this.getComment();
        this.subject = "";
      });
    },
    async deleteComment(comment_id) {
      axios.delete("/blog_comment/" + comment_id);
      await this.$nextTick()
        .then(response => {
          this.getComment();
          toastr.info("Successfully deleted a Comment!");
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    editComment(comment_id) {
      this.editCommentTab = !this.editCommentTab;
    },
    async updateComment(comment_id, comment_new_subject) {
      axios.put("/blog_comment/" + comment_id + "/update", {
        subject: comment_new_subject
      });
      await this.$nextTick()
        .then(response => {
          this.getComment();
          this.isModalVisible = false;
          toastr.info("Successfully updated a Comment!");
        })
        .catch(error => {
          console.log(error);
        });
    },
    listen() {
      Echo.join("channel-comment")
        .here(users => {})
        .joining(user => {})
        .leaving(user => {})
        .listen("NewComment", e => {
          this.comments.push(e);
        });
    }
  }
};
</script>

<style scoped>
/* MODAL */

.modal-fade-enter,
.modal-fade-leave-active {
  opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.5s ease;
}

.modal {
  box-shadow: 2px 2px 20px 1px;
  overflow-x: auto;
  display: flex;
  flex-direction: column;
}

.modal-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-body {
  position: relative;
  padding: 20px 10px;
}

/* COMMENT */

.container-commnent {
  margin: 2%;
}

.container-user-comment {
  float: left;
}

.container-edit-delete {
  margin-left: 10%;
}

.comment-username,
.comment-subject {
  margin-left: 10%;
}

.comment-subject {
  margin-top: 1%;
}

.comment-ava {
  width: 60px;
  margin-bottom: 2%;
}

.comment-username,
.comment-subject {
  display: block;
}

.container-like-unlike {
  margin: 2% 0 2% 10%;
}

.comment-likes,
.comment-unlikes {
  cursor: pointer;
  background: rgb(132, 137, 133);
  width: 25px;
  height: 25px;
}

.comment-likes {
  content: url("like.png");
}

.comment-unlikes {
  content: url("unlike.png");
}

.container-textarea-comment {
  width: 50%;
  margin: 2.5% 0;
  display: flex;
  align-items: center;
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

.button-comment-update {
  display: inline-block;
  text-align: center;
  padding: 8px;
  background: white;
  border: 0.5px solid rgba(37, 37, 37, 0.5);
}

.button-comment,
.button-comment-update {
  display: block;
  text-align: center;
  margin-left: 8px;
  padding: 8px;
  border: 0.5px solid rgba(37, 37, 37, 0.5);
  color: rgba(37, 37, 37, 0.5);
}

.disabled {
  cursor: not-allowed;
}
</style>
