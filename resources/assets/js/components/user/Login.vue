<template>
    <div>
       <input v-validate="'required|email'" data-vv-as="email" v-model="email" name="email" type="text" autofocus>
       <span class="errors_email" v-if="errors.first('email')">{{ errors.first('email') }}</span>
       <input v-validate="'required|password'" data-vv-as="password" v-model="password" name="password" type="password" autofocus>
       <span v-show="errors.has('password')" class="errors_password">{{ errors.first('password') }}</span>
        <!-- <input name="email" type="email" v-model.trim="email">
        <span v-if="msg.email"> {{ msg.email }} </span>
        <input name="password" type="password" v-model.trim="password">
        <a href="#!" @click.prevent="login(email, password)"> submit </a> -->
    </div>
</template>

<script>
export default {
  data() {
    return {
        email: "",
        password: "",
      //   msg: []
    };
  },
//   watch: {
//     email(value) {
//       this.email = value;
//       this.check_email(value);
//     }
//   },
  methods: {
    // check_email(value) {
    //   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
    //     this.msg["email"] = "";
    //   } else {
    //     this.msg["email"] = "Keep Typing... We are waiting fo r correct Email";
    //   }
    // },
    // check_password(value) {},

    login() {
      
    }
  }
};
</script>

<style scoped>
.errors_email, 
.errors_password {
    margin-top: 5px;
    padding: 8px; 
    color: whitesmoke;
    display: block;
    background: rgb(255, 100, 100);    
}
</style>
