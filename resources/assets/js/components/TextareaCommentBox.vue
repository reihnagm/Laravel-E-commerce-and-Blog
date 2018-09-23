<template>
    <div>
     <div class="_column">
      <textarea v-model="subject"> </textarea>
      <input @click.prevent="submitComment()" type="submit" class="_button">
     </div>
    </div>
</template>

<script>

    export default {
        props: ['user_id', 'blog_id'],
        data() {
            return{
             subject: ''
            }
        },
        methods: {
            submitComment() {

                axios({
                 url:'/api/blog-comment/'+ this.blog_id,
                 method: 'POST',
                 data: {
                  subject : this.subject,
                  user_id: Laravel.user.id
                 }
                }).then((res) => {
                    this.subject =  ''
                }).catch((res) => {
                    console.log(res)
                })

            }
        }
    }
</script>

<style scoped>
    
</style>