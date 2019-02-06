<template>
<div class="container">
  <h3>Users Online: {{ users.length }}</h3>
  <ul class="box-users-online">
    <li v-for="user in users" :key="user.id">
      <a target="_blank" :href="'/profile/'+ user.slug">{{ user.name }}</a> 
    </li>
  </ul>
  <br>
  <a class="button" href="/">back to Homepage</a> <br> <br>
  <a class="button" href="/profile">back to Profile</a>
</div>

<!-- 
user.slug
user.id
user.name p 
THIS DATA GETTING ON channel-chat
 -->
</template>



<script>
import Bus from "../../bus";

export default {
  data() {
    return {
      users: []
    };
  },
  mounted() {
    Bus.$on("chat.here", users => {
        this.users = users;
      })
      .$on("chat.joining", user => {
        this.users.push(user);
      })
      .$on("chat.leaving", user => {
        this.users = this.users.filter(u => {
          return u.id !== user.id;
        });
      });
  }
};
</script>


<style lang="scss" scoped>
.box-users-online {
    padding: 16px;
    background: transparent;
    border: 2px dotted #8b7d7b;
}

.box_users-online li {
    margin: 12px 0 0 12px;
    color: black;
    list-style: disc;
}
.box-users-online li a {
    color: black;
    text-decoration: underline;
}
</style>
