<template>
    <div class="container">
        <h3>Users Online: {{ users.length }} </h3>
        <ul class="_box_users_online">
            <li v-for="user in users" :key="user.id">
               <a target="_blank" :href="'/profile/'+ user.slug"> {{ user.username }} </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import Bus from '../../bus'

    export default {
        data(){
            return {
                users: []
            }
        },
        mounted() {
            Bus.$on('chat.here', (users)=> {
                this.users = users
                console.log(this.users)
            }).$on('chat.joining', (user)=> {
                this.users.push(user)
            }).$on('chat.leaving', (user) => {
                this.users = this.users.filter((u) => {
                    return u.id  !== user.id
                })
            })
        }
    }
</script>


<style lang="scss" scoped>
    ._box_users_online {
        padding: 16px; 
        background: transparent;
        border: 2px dotted #8b7d7b;
       
    }

    ._box_users_online li {
        margin: 12px 0 0 12px;
          color: black;
        list-style: disc;
    }
     ._box_users_online li a {
        color: black; 
        text-decoration: underline;
    }
</style>
