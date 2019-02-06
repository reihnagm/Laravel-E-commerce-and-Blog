<template>
  <div>
    <table>
      <tr>
        <th>ID</th>
        <th>TITLE</th>
        <th>CAPTION</th>
        <th>DESC</th>
        <th>CATEGORY</th>
        <th>IMG</th>
        <th>DATE CREATED</th>
        <th>DATE UPDATED</th>
        <th>OWNER</th>
        <th>OPTION</th>
      </tr>
  
      <template v-for="blog in blogs">
        <tr>
          <td>{{ blog.id }}</td>
          <td>{{ blog.title.toUpperCase() }}</td>
          <td>{{ blog.caption.toUpperCase() }}</td>
          <td>{{ blog.desc.toUpperCase() }}</td>
           <template v-for="tag in blog.tags">
            <td> {{ tag.name }} </td> 
           </template>
          <td>
            <img :src="blog.img">
          </td>
          <td>{{ blog.created_at.toUpperCase() | moment("dddd, MMMM Do YYYY") }}</td>
          <td>{{ blog.updated_at.toUpperCase() | moment("dddd, MMMM Do YYYY") }}</td>
          <td>{{ blog.user.username.toUpperCase() }}</td>
          <td>
            <a href="#!" @click.prevent="deleteBlog(blog.id)">DELETE</a> |
            <a href="#!" @click.prevent="showModal(blog)">EDIT</a>
          </td>
        </tr>
      </template>
    </table>

    <transition name="modal-fade">
      <div v-if="isModalVisible">
        <div class="modal">
          <div class="modal-backdrop">
            <div class="modal-body">
              <br>
              <a href="#!" class="button" @click.prevent="closeModal()">X</a>
              <br>
              <br>
              <label for="Title"></label>
              <textarea id="title" v-model="modalData.title"></textarea>
              <br>
              <input type="file" @change="changeImage">
              <br>
              <br>
              <img :src="modalData.img">
              <br>
              <label for="caption">Caption</label>
              <br>
              <br>
              <textarea id="caption" v-model="modalData.caption"></textarea>
              <br>
              <br>
              <label for="desc">Desc</label>
              <br>
              <br>
              <textarea id="desc" name="desc" v-model="modalData.desc"> {{ modalData.desc }} </textarea>
              <br>
              <br>
               <select v-model="modalData.tags">
                <template v-for="tag in tags">
                  <!-- <template v-for="oldTag in modalData.tags"> -->
                       <option :value="tag.id"> {{ tag.name }}</option>
                  <!-- </template> -->
                </template>
              </select>
              <br>
              <label for="username">Username</label>
              <br>
              <br>
              <select >
                <template v-for="user in users">
                    <option :value="user.id">  {{ user.username }} </option>
                </template>
              </select>
              <br>
              <br>
              <a
                href="#!"
                class="button"
                @click.prevent="updateBlog(modalData.id, modalData.title, modalData.caption, modalData.desc, modalData.tags)">Update Blog</a>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props:["users", "tags"],
  data() {
    return {
      blogs: [],
      blog_img: "",
      isModalVisible: false,
      modalData: {}
    };
  },
  mounted() {
    this.getAllDataBlogs();
  },
  methods: {
    async getAllDataBlogs() {
      await axios.get("/api/blogs_index").then(response => {
        this.$nextTick(() => {
          this.blogs = response.data;
        }).catch(response => {
          console.log(response);
        });
      });
    },
   async deleteBlog(userId) {
     await axios
        .delete("/api/blog_destroy" + userId)
        .then(response => {
          console.log(response);
        })
        .catch(response => {
          console.log(response);
        });
    },
    showModal(blog) {
      this.isModalVisible = true;
      this.modalData = JSON.parse(JSON.stringify(blog));
    },
    closeModal() {
      this.isModalVisible = false;
    },
    async updateBlog(blogId, blogTitle, blogCaption, blogDesc, blogTags) {
      let url = "/api/blog_update/" + blogId;
      let data = {
        method: "PUT",
        'title': blogTitle,
        'caption': blogCaption,
        'img': this.blog_img,
        'desc': blogDesc,
        'tags': blogTags,
        'user_id': 33,
        _token: window.Laravel.csrfToken
      };
      await axios
        .put(url, data)
        .then(response => {
          console.log(response);
        })
        .catch(response => {
          console.log(response);
        });
    },
    async deleteBlog(blogId) {
      let url = "/api/blog_destroy/" + blogId;
      let data = {
        method: "DELETE",
        _token: window.Laravel.csrfToken
      };
      await axios
        .delete(url, data)
        .then(response => {
          this.getAllDataBlogs();
          console.log(response);
        })
        .catch(response => {
          console.log(response);
        });
    }, 
      changeImage(e) {
      let image = e.target.files[0];
      this.read(image);
    },
      read(image) {
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.blog_img = e.target.result;
      };
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

.modal-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  width: 100%;
  justify-content: center;
  align-items: center;
}

.modal-body {
  overflow-y: scroll;
  height: 100%;
  width: 50%;
}

.modal-body img {
  width: 100%;
  display: block;
  margin: 0 auto;
}
</style>
