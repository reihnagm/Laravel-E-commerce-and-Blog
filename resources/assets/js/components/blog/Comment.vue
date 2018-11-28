<template>
 <div>
     <div v-for="comment in comments" :key="comment.id">
         <span class="comment_username"> {{ comment.user.username }}  </span> 
         <span class="comment_subject"> {{ comment.subject }} </span> 
         <span @click.prevent="like(comment.id)" class="comment_likes"></span> {{ comment.likes_count }}
         <span @click.prevent="unlike(comment.id)" class="comment_unlikes"></span> {{ comment.unlikes_count }}
          <!-- <button type="button" @click="showModal">
            Open Modal!
          </button> -->
          <!-- <modal v-show="isModalVisible" @close="closeModal"/> 2 types write component can use this and below -->
       
          <!-- <textarea v-model="comment.subject"></textarea> 
          <a href="#!" @click.prevent="changeComment(comment.id, comment.subject)">update comment</a> -->
          <div class="_options">
           <a href="#!" @click.prevent="showModal(comment)">Edit</a>
           <!-- <a href="#!" @click.prevent="editComment(comment.id)">Edit</a> -->
           <a href="#!" @click.prevent="deleteComment(comment.id)">Delete</a>
         </div>
      </div>
      
       <!-- SHOW SINGLE MODAL -->
       <transition name="modal-fade">
          <div v-show="isModalVisible">
           <div class="modal"> 
            <div class="modal-backdrop">
              <div class="modal-body">
                 <button type="button" @click="closeModal"> X </button>
                 <textarea class="comment_update_textarea_" v-model="modalData.subject"></textarea>
                 <a href="#!" class="button_comment_update" @click.prevent="changeComment(modalData.id, modalData.subject)">update comment</a>
              </div>
            </div>
          </div>
        </div>
       </transition>
      
      <div class="wrapper_textarea_comment">
        <textarea class="textarea_comment" v-model="subject"></textarea>
        <a href="#!" class="button_comment"  @click.prevent="sentComment()">Comment</a>
      </div>
     
 </div> 
</template>

<script>
import Bus from "../../bus";

export default {
  props: ["blog_id", "user_id"],
  data() {
    return {
      isModalVisible: false,
      modalData: {},
      subject: "",
      comment: {
        subject: ""
      },
      comments: [
        {
          user: {
            username: ""
          },
          subject: "",
          likes_count: 0,
          unlikes_count: 0
        }
      ]
    };
  },
  mounted() {
    this.getComment();
    // Bus.$on("comment.sent", newComment => {
    //   this.comments.push(newComment)
    // });
  },
  methods: {
    showModal(comment) {
      this.isModalVisible = true;
      this.modalData = JSON.parse(JSON.stringify(comment));
    },
    closeModal() {
      this.isModalVisible = false;
    },
    getComment() {
      axios.get("/api/blog-comment").then(response => {
        this.comments = response.data.data;
      });
    },
    async sentComment() {
      axios.post("/api/blog-comment/" + this.blog_id + "/" + this.user_id, {
        subject: this.subject
      });
      await this.$nextTick().then(response => {
        this.getComment();
        this.subject = "";
      });
    },
    like(comment_id) {
      axios.get("like/" + comment_id + "/2").then(response => {
        if (response.data.message == "like") {
          let index = this.comments.findIndex(
            comment => comment.id === comment_id
          );
          this.comments[index].likes_count++;
          this.changed_like_to_unlike(comment_id);
        } else {
          this.cancel_like(comment_id);
          let index = this.comments.findIndex(
            comment => comment.id === comment_id
          );
          this.comments[index].likes_count--;
        }
      });
    },
    cancel_like(comment_id) {
      axios.get("/cancel_like/" + comment_id + "/2").then(response => {});
    },
    unlike(comment_id) {
      axios.get("unlike/" + comment_id + "/2").then(response => {
        if (response.data.message == "unlike") {
          let index = this.comments.findIndex(
            comment => comment.id === comment_id
          );
          this.comments[index].unlikes_count++;
          this.changed_unlike_to_like(comment_id);
        } else {
          this.cancel_unlike(comment_id);
          let index = this.comments.findIndex(
            comment => comment.id === comment_id
          );
          this.comments[index].unlikes_count--;
        }
      });
    },
    cancel_unlike(comment_id) {
      axios.get("/cancel_unlike/" + comment_id + "/2").then(response => {});
    },

    changed_like_to_unlike(comment_id) {
      axios.get("/cancel_unlike/" + comment_id + "/2").then(response => {});
      let index = this.comments.findIndex(comment => comment.id === comment_id);
      if (this.comments[index].unlikes_count > 0) {
        this.comments[index].unlikes_count--;
      }
    },
    changed_unlike_to_like(comment_id) {
      axios.get("/cancel_like/" + comment_id + "/2").then(response => {});
      let index = this.comments.findIndex(comment => comment.id === comment_id);
      if (this.comments[index].likes_count > 0) {
        this.comments[index].likes_count--;
      }
    },

    async deleteComment(comment_id) {
      axios({
        method: "DELETE",
        url: "/api/blog-comment/" + comment_id,
        headers: { "X-CSRF-TOKEN": $('meta[name="token"]').attr("content") }
      });
      await this.$nextTick() // same with settimeout
        .then(response => {
          this.getComment();
          toastr.info("comment was deleted!");
        })
        .catch(err => {
          console.log(err);
        });
    },
    editComment(comment_id) {
      // console.log(event); detect event
      this.editCommentTab = !this.editCommentTab;
    },
    async changeComment(comment_id, comment_new_subject) {
      var url = "/api/blog-comment/" + comment_id + "/update";
      var data = {
        method: "PUT",
        subject: comment_new_subject,
        _token: window.Laravel.csrfToken
      };
      axios.put(url, data);
      await this.$nextTick()
        .then(response => {
          this.getComment();
          this. isModalVisible = false
          // var index = this.comments.findIndex(
          //   comment => comment.id == comment_id
          // );
          // this.comments[index].subject = "";
          toastr.info("comment was updated!");
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.modal-fade-enter,
.modal-fade-leave-active {
  opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.5s ease;
}

.modal {
  background: #ffffff;
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

.comment_wrapper {
  display: flex;
  align-items: center;
}

.comment_username {
  margin-bottom: 5px;
}

.comment_username,
.comment_subject {
  display: block;
}

.comment_likes {
  background: rgb(132, 137, 133);
  content: url("like.png");
  width: 25px;
  height: 25px;
}

.comment_unlikes {
  background: rgb(132, 137, 133);
  content: url("unlike.png");
  width: 25px;
  height: 25px;
}

.wrapper_textarea_comment {
  display: flex;
  padding: 5px;
  align-items: center;
  margin-right: 8px;
}

.textarea_comment, {
  padding: 8px;
  color: rgba(37, 37, 37, 0.5);
  resize: none;
  overflow-y: scroll;
}

.textarea_comment:focus {
  outline: none;
}

.button_comment_update {
  display: inline-block;
  text-align: center;
  padding: 8px; 
  background: white;
  border: 0.5px solid rgba(37, 37, 37, 0.5);
}

.button_comment,
.button_comment_update {
  display: block;
  text-align: center;
  margin-left: 8px;
  padding: 8px;
  border: 0.5px solid rgba(37, 37, 37, 0.5);
  color: rgba(37, 37, 37, 0.5);
}
</style>
