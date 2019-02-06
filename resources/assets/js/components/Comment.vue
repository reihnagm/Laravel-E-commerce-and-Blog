<template>
    <div>
     <!-- <div class="_column" v-for="blog in blogs.comments" :key="blog.id">
        <div id="_comment_profile" >
         <img src="https://picsum.photos/200/300" alt="">
         <div>
         <span> {{ blog.user.username }} </span>
         <p> {{ blog.subject }}  </p>
         </div>
        </div>

         <a class="_button _has_range_top" @click="like()" href="#!"> Like </a>
     </div>  -->

        <div class="_column" v-for="blogcomment in blogcomments.data" :key="blogcomment.id">
            <div v-if="bloguserid == userid">
              <div id="_comment_profile" >
                  <img src="https://picsum.photos/200/300" alt="">
                  <div>
                      <span> {{ blogcomment.user.username }} </span>
                      <p> {{ blogcomment.subject }}  </p>
                  </div>
              </div>

            <span v-if="bloguserid == userid">
              <transition name="bounce">
                <div v-if="edit" class="_has_range_top">

                    <textarea v-model="subject" id="_textarea_comment" class="_has_range_bottom"> </textarea>
                    <input @click="editComment(blogcomment.id)" class="_button" type="submit" name="submit" value="update comment">

                </div>
              </transition>
            </span>

            <a class="_button _has_range_top" @click="likeComment()" href="#!"> Like </a>
            <span v-if="userid == blogcomment.user.id">
                <a @click="edit = !edit" class="_button _has_range_top" href="#!"> Edit </a>
                <a class="_button"  @click="deleteComment(blogcomment.id)" href="#!"> Delete </a>
            </span>
            </div>
        </div>

       <div v-if="bloguserid == userid">
        <div class="_column">
         <a @click.prevent="fetchDataComment(pagination.prev_page_url)" href="#!" v-bind:class="[{disabled: !pagination.prev_page_url}]" class="_button"> Previous comment </a>
         <span class="_text_gray"> Page {{ pagination.current_page }} of {{ pagination.last_page }} Page </span>
         <a @click.prevent="fetchDataComment(pagination.next_page_url)" href="#!" v-bind:class="[{disabled: !pagination.next_page_url}]" class="_button"> Next comment </a>

        <div class="_column _is_half">
          <textarea v-model="subject" id="_textarea_comment" class="_has_range_bottom"></textarea>
          <input @click="submitComment()" class="_button" type="submit" name="submit" value="Comment">
        </div>
       </div>
      </div>

    </div>
</template>

<script>
export default {
    props:['blogid', 'bloguserid', 'userid'],
    data() {
        return {
            subject: '',
            pagination: [],
            blogcomments: [],
            edit:false
        }
    },

    methods: {
        fetchDataComment(url) {
        url = url || "/api/blog-comment"
        axios.get(url)
         .then((res) => {
         this.blogcomments = res.data
         this.makePagination(res.data.meta, res.data.links);
         })
         .catch((err) => {
           console.log(err)
         });
       },
       makePagination(meta, links) {
        let pagination = {
         current_page : meta.current_page,
         last_page : meta.last_page,
         next_page_url : links.next,
         prev_page_url : links.prev
        }

        this.pagination = pagination
       },
       submitComment() {
          axios({
            method: 'post',
            url: '/api/blog-comment/' + this.blogid,
            data: {
             subject: this.subject,
             user_id: this.userid
            }
          }).then((res) => {
             this.fetchDataComment()
             this.subject = ''
          }).catch((err) => {
              console.log(err)
          })
       },
       deleteComment(id) {
           axios({
            method: 'delete',
            url: '/api/blog-comment/' + id,
            }).then((res) => {
              this.fetchDataComment()
            }).catch((err) => {
              console.log(err)
           });
        },
        editComment(id) {
            axios({
            method: 'put',
            url: '/api/blog-comment/' + id + '/update',
            data: {
                subject: this.subject
             }
          }).then((res) => {
              this.fetchDataComment()
              this.subject = ''
          }).catch((err) => {
              console.log(err)
          })
        }
    //    paginate(url = '') {
    //     axios.get(url ? url: '/blog-comment/paginate').then((res) => {
    //         if (! this.comments.data) {
    //           this.comments = res.data
    //         }
    //         else {
    //           this.comments.data.push(...res.data)
    //           this.comments.next_page_url = res.data.next_page_url
    //           this.fetchDataComment()
    //         }
    //         }).catch((err) => {
    //         console.log(er)
    //         })
    //    }
    },

    mounted() {
        this.fetchDataComment()
        // this.paginate()
    }

}
</script>


<style scoped>
.bounce-enter-active {
  animation: bounce-in .5s;
}
.bounce-leave-active {
  animation: bounce-in .5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}
</style>
