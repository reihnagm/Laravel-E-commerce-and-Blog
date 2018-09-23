<template>
  <div>      
   
      <div class="_column _blog">
          <div v-if="userid == blog.user.id">
            <h1> {{ blog.title  }} </h1>
            <span v-for="tag in blog.tags" :key="tag.id">
            {{tag.name }}
            </span>
            <span> Author : {{ blog.user.username  }} </span>
            <img :src="blog.img">  <!-- 'assets/blogs/images/'  -->
            <p v-html="blog.desc"> {{ blog.desc }} </p>
            <a @click.prevent="deleteBlog(blog.id)" class="_button _has_range_top" href="#!">delete</a>
            <a @click.prevent="editBlog(blog.id)" class="_button _has_range_top" href="#!">edit</a>
             <!-- <h2 class="_text_gray _has_range_top"> Whats is your reaction ?</h2> -->

            <div v-for="comment in blog.comments" :key="comment.id">
                <div id="_comment_profile">
                    <div>
                     
                        <img src="https://picsum.photos/200/300" alt="">
                        <p> {{ comment.user.username }} <p>
                        <p> {{ comment.subject }}  </p> 

                        <transition name="bounce">
                        <div v-if="edit" class="_has_range_top">
                        <textarea v-model="subject" id="_textarea_comment" class="_has_range_bottom"> </textarea>
                        <input @click="updateComment(comment.id)" class="_button" type="submit" name="submit" value="Update Comment"> 
                        </div>
                        </transition>

                        <a @click="editComment(comment.id)" class="_button _has_range_top" href="#!"> Edit </a>
                        <a class="_button"  @click="deleteComment(comment.id)" href="#!"> Delete </a>
                 
                      </div>
                    </div>
                </div>
            </div>

          <div v-if="userid == blog.user.id">
           <div class="_column _is_half">
            <textarea ref="subject" id="_textarea_comment" class="_has_range_bottom"></textarea>
             <input @click="submitComment()" class="_button" type="submit" name="submit" value="Comment">
           </div>
        
            <div class="_columns _is_multiline">
                <div class="_column _is_one_third" v-for="recent in recents.data" :key="recent.id">
                    <div class="_blog_recently">
                        <img :src=recent.img>
                        <h2 class="_has_range_top _text_gray"> {{ recent.title }} </h2>
                        <a class="_button _has_range_top" href="#!"> Continue reading </a>
                    </div>
                </div> 
            </div>
         </div>
        </div>

   
    </div>
</template>

<script>

import Bus from '../bus'

export default {
    props: ['userid'],
    data() {
        return {
         subject:'',
         edit:false,
         blog: [],
         recents:[]
        }
    },
    methods:{
     fetchDataBlog() {
         axios({
          method: 'get',
          url: '/api/blog'
         }).then((res) => {
            // why deep object data ? because in controller use BlogResource  
            this.blog = res.data.data
         }).catch((err) => {
             console.log(err)
         })
     },
     fetchDataRecentsBlog() {
          axios({
        method: 'get',
        url: '/api/blog/recents'
        }).then((res) => {
        this.recents = res.data
        }).catch((err) => {
            console.log(err)
        })
     },
     editBlog(id) {
         axios({
            method: 'put',
            url:'/api/blog/' + id + '/update',
            data: {
             'title': this.blog.title,
             'img': this.blog.img
            }
         }).then((res) =>{

         }).catch((err) => {
             console.log(err)
         })
     },
     editComment(id){
        if(id) {
            this.edit = !this.edit
        }
     },
     updateComment(id) {
            axios({
            method: 'put',
            url: '/api/blog-comment/' + id + '/update',
            data: {
                subject: this.subject // subject // left is request in controller // right is value 
             }
          }).then((res) => {
              this.fetchDataBlog()
              this.subject = ''
          }).catch((err) => {
              console.log(err)
          }) 
        },
      deleteBlog(id) {
         axios({
            method: 'delete',
            url:'/api/blog/' + id 
         }).then((res) => {
            location.reload()
            toastr.info('Blog has been deleted!')
         }).catch((err) => {
            console.log(err)
         })
     },
     deleteComment(id) {
           axios({
            method: 'delete',
            url: '/api/blog-comment/' + id
            }).then((res) => {
              this.fetchDataBlog()
              toastr.info('Comment has been deleted!')
            }).catch((err) => {
              console.log(err)
           });
        },
      submitComment() {
            if(!this.$refs.subject.value) {
               toastr.info('fill comment input!')
            } 
            axios({
            method: 'post',
            url: '/api/blog-comment/' + this.blog.id,
            data: {
                subject: this.$refs.subject.value,
                user_id: this.userid
            }
            }).then((res) => {
                this.fetchDataBlog()
                this.$refs.subject.value = ''
            }).catch((err) => {
                console.log(err)
            })
       }
    },
    mounted() {
     this.fetchDataBlog()
     this.fetchDataRecentsBlog()

     Bus.$on('blog.published', (data) => {
        console.log('masuk pada on bus')
     })

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
