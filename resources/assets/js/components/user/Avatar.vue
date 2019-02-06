<template>
<div>
  <img :src="avatar">
  <input type="file" name="avatar" @change="changeAvatar">

  <span v-if="file">
    <a href="#!" class="button" @click.prevent="upload"> Upload </a>
  </span>

</div>
</template>

<script>
export default {
  props: ["user", "user_id"],
  data() {
    return {
      avatar: this.user,
      file: ""
    };
  },
  methods: {
    changeAvatar(e) {
      var image = e.target.files[0];
      this.file = image
      this.read(image);
    },
    read(image) {
      var reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.avatar = e.target.result;
      };
    },
    upload() {
      var url = '/change_avatar/' + this.user_id + '/update';
      var data = {
        method: "PUT",
        avatar: this.avatar,
        _token: window.Laravel.csrfToken
      };
      axios.put(url, data).then((response) => {
        toastr.info('Successfully change ava!');
        location.reload();
      }).catch((error) => {
        console.log(error.response)
        toastr.info('Something error happened!');
      })
    }
  }
};
</script>

<style scoped>
input[type="file"] {
  margin: 5% 0;
}

img {
  width: 100px;
}
</style>
