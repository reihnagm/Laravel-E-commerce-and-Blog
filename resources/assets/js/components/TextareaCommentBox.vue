<template>
    <div>
     <div class="_column">
         <form action="">
               <textarea @keydown="handleInput" v-model="subject"> </textarea>
         </form> 
     </div>
    </div>
</template>

<script>

    export default {
        props: ['blog_id'],
        data() {
            return{
             subject: ''
            }
        },
        methods: {
            handleInput(e) {

            if(e.keycode == 13 && !e.shiftkey)
            e.preventDefault();
            this.submit()

            },
            submit() {

                axios({
                 url:'/api/blog-comment/'+ this.blog_id,
                 method: 'POST',
                 data: {subject : this.subject}
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