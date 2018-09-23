<template>
 <div>

    <div class="_column">
        <h2 class="_text_gray"> {{ username.username }} blogs </h2>
        <a class="_has_range_top _button" @click="show = !show" href="#!"> create a blog </a>
    </div>

     <transition name="bounce">
      <div v-if="show">
        <div class="_column _back_gray _has_large_padding">
        <div class="_field">
            <input id="title" v-model="blog.title" type="text" placeholder="Title">
        </div>
        <div class="_field">
            <label for="file" class="_text_gray"> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
            <input @change="getImage" name="img" id="file" class="_inputfile" type="file">
        </div>
        <div class="_field">
            <editor v-model="blog.desc"></editor>
        </div>
        <label for="tag" class="_text_gray"> Select tag : </label>
        <select id="tag" v-model="blog.tags" multiple>
            <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
        </select>
        <a @click.prevent="addBlog()" class="_button _has_range_top">Publish</a>
        <a class="_button _has_range_top ">Save to Draft</a>
        </div>
     </div>
    </transition>
    
 </div>
</template>

<script>

import Editor from '@tinymce/tinymce-vue'

import Bus from '../bus'

export default {
    
    props:['username','userid'],
      components: {
         'editor': Editor,
        },  
    data() {
        return {
         tags: [],
         blog: {
             title: '',
             desc: '',
             img: '',
             tags: [],
          },
          show: false,
        }
    },

    methods: {
    getImage(e) {
     let image = e.target.files[0]
     if(image.size > 1048576) {
        toastr.info('your image is over limit. maximal  1 Gigabyte :)')
     }
     let reader = new FileReader()
     reader.readAsDataURL(image)
        reader.onload = e => {
            this.blog.img = e.target.result
            // base64 BLOB
        }
     },
    fetchDataTag() {
        axios({
            method: 'get',
            url: '/api/tags'
        }).then((res) => {
            this.tags = res.data
        }).catch((err) => {
            console.log(err)
        })
    },
    addBlog() {

         if (!this.blog.title) {
            toastr.info('fill title input :)')
          }

         if (!this.blog.desc) {
            toastr.info('fill description input :)')
          }

        let data = {
            title: this.blog.title,
            desc: this.blog.desc,
            img: this.blog.img,
            tags: this.blog.tags,
            user_id: this.userid
        }

        axios({
          method: 'post',
          url: '/api/blog',
          data: data
        }).then((res) => {
            Bus.$emit('blog.published', data)
            console.log('masuk pada emit bus')
        }).catch((err) => {
            console.log(err)
        })
     }
   },

   mounted() {
       this.fetchDataTag()
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