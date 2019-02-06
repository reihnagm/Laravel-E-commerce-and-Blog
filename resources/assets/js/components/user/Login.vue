<template>
<div>

  <div class="is-error" v-show="errors.any()">
    <div v-if="errors.has('email')">
      {{ errors.first('email') }}
    </div>
    <div v-if="errors.has('password')">
      {{ errors.first('password') }}
    </div>
  </div>

  <span class="is-error" v-if="credentials_not_found.length">
    {{ credentials_not_found }}
  </span>

  <div class="field">
    <form id="login" @submit.prevent="login" method="post" novalidate="true">
      <label for="email"> E-mail Address </label>
      <input type="email" v-validate="'required|email'" id="email" v-model="loginUser.email" name="email">
      <label for="password-field"> Password </label>
      <div class="wrapper-input-password">
        <input id="password-field" type="password" v-validate="'required|password'" v-model="loginUser.password" name="password">
        <i toggle="#password-field" class="eye-icon"></i>
      </div>
      <input type="submit" value="Login">
    </form>
  </div>

</div>
</template>

<script>
export default {
  data() {
    return {
      credentials_not_found: '',
      loginUser: {
        email: null,
        password: null
      }
    }
  },
  methods: {
    login() {
      axios.post('/login', this.loginUser).then(response => {
          location.reload();
        })
        .catch(error => {
          if (error.response.data.errors.email) {
            error.response.data.errors.email.forEach((data) => {
              this.credentials_not_found = data
            })
          }
        });
    },
    validEmail(email) {
      var regexp = /[a-zA-Z0-9_]+@[a-zA-Z]+\.(com|net|org)$/;
      return regexp.test(email);
    },
    validPassword(password) {
      var regexp = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/;
      return regexp.test(password)
    }

  }
};
</script>

<style scoped>
input[type="submit"] {
  cursor: pointer;
}
</style>
