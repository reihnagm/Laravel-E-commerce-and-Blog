<template>
    <div>
        <form action="#">
             <div class="form-group">
                 <textarea
                  v-model="body"
                     @keydown="handleInput"
                     placeholder="Chat here.."></textarea>
             </div>
        </form>
    </div>
</template>

<script>
    import moment from 'moment'
    import Bus from '../../bus'

    export default {
        data() {
            return {
                body : null
            }
        },
        methods: {
            handleInput(e) {
                if(e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault()
                    this.submit()
                }
            },
            submit() {
                if(!this.body || this.body.trim() === '') {
                    return
                }

                let newMessage = {
                  //id: Date.now(),
                    subject: this.body.trim(),
                    created_at : moment().utc(0).format('YYYY-MM-DD HH:mm:ss'),
                    user: {
                        name: Laravel.user.name
                    }
                }
                // message.user.username = laravel.user.username = (Auth::user()->username)

                let backup = this.body.trim()

                Bus.$emit('chat.sent', newMessage)
                
                this.body = ''

                axios.post('/messages', {subject: backup})
                    .then(response => {
                 
                    })
                    .catch(() => {
                        this.body = backup
                        Bus.$emit('chat.removed', newMessage)
                        console.log(newMessage)
                        console.log(this.body)
                        console.log('ada error')
                    })
            }
        },
    }
</script>

<style lang="scss" scoped>
    textarea{
        width: 100%;
        height: 50px;
        border: none;
        outline: none;
        border-bottom: 1px solid gray;
    }
    textarea:hover,
    textarea:focus {
        border-bottom: 1px solid gray;
    }
</style>
