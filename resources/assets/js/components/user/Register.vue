<template>
    <div>

        <div class="is-error" v-if="errors.any()">
          <span v-if="errors.has('name')">
            {{ errors.first('name') }}
          </span>
          <span v-if="errors.has('email')">
            {{ errors.first('email') }}
          </span>
          <span v-if="errors.has('password')">
            {{ errors.first('password') }}
          </span>
        </div>

        <span class="is-error" v-if="name_required.length">
          {{ name_required }}
        </span>

        <span class="is-error" v-if="email_required.length">
          {{ email_required }}
        </span>

        <span class="is-error" v-if="password_required.length">
          {{ password_required }}
        </span>

        <div class="field form-register" v-show="hidden">
          <form id="register" @submit.prevent="register" method="post" novalidate="true">
            <label for="name"> Name </label>
            <input type="text" v-validate="'required|name'" v-model="registerUser.name" name="name" id="name" placeholder="Name">
            <label for="email"> E-mail Address </label>
            <input type="email" v-validate="'required|email'" v-model="registerUser.email" name="email" placeholder="E-mail Address">
            <label for="password-field-register"> Password </label>
            <div class="wrapper-input-password">
            <input type="password" id="password-field-register" v-validate="'required|password'" v-model="registerUser.password"
            name="password" placeholder="Password">
            <i toggle="#password-field-register" class="eye-icon"> </i>
            </div>
            <input type="submit" value="Register">
           </form>
         </div>


        <a class="button" @click.prevent="showRegister()"> Register </a>

    </div>
</template>

<script>
  export default {
	props: ['check_email_user'],
    data() {
      return {
        hidden:false,
        name_required: '',
        email_required: '',
        password_required: '',
          registerUser: {
            name: null,
            email: null,
            password: null
          },
      }
    },
    methods: {
      register() {
        axios.post("/register", this.registerUser).then( response => {
           location.reload();
        }).catch(error => {
			
            if(error.response.data.errors.name) {
            error.response.data.errors.name.forEach((data) => {
              this.name_required = data;
            })
           }
            if(error.response.data.errors.email) {
              error.response.data.errors.email.forEach((data) => {
                this.email_required = data;
              })
            }
           if(error.response.data.errors.password) {
            error.response.data.errors.password.forEach((data) => {
              this.password_required = data;
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
        return regexp.test(password);
      },
      showRegister() {
        this.hidden = !this.hidden;
      }

    }
  };
</script>

<style scoped>
  input[type="submit"] {
    cursor: pointer;
  }
  .form-register {
    padding-top: 20px;
  }
</style>
