<template>
<div>

  <div v-if="avatar">
    <div v-if="image">
      <img :src="image" style="width: 100px;">
    </div>
    <div v-else>
      <img :src="avatar" style="width: 100px;">
    </div>
  </div>
  <div v-else>
    <img :src="gravatar" style="width: 100px;">
  </div>

 <span v-if="auth_user">
  <input type="file" @change="changeAvatar">
 </span>

  <span v-if="checkFile">
    <a href="#!" class="button" @click="upload"> Upload </a>
  </span>

</div>
</template>

<script>
export default {
  props: ["avatar_user", "avatar_gravatar", "auth_user", "user_id"],
  data() {
    return {
      avatar: this.avatar_user,
      gravatar: this.avatar_gravatar,
      image: "",
      checkFile: ""
    };
  },
  computed: {
    getMonth() {
      var month = new Array();
      month[0] = "January";
      month[1] = "February";
      month[2] = "March";
      month[3] = "April";
      month[4] = "May";
      month[5] = "June";
      month[6] = "July";
      month[7] = "August";
      month[8] = "September";
      month[9] = "October";
      month[10] = "November";
      month[11] = "December";

      var date = new Date();
      var month = month[date.getMonth()];

      return month;
    },
    getYear() {
      return new Date().getUTCFullYear()
    },
  },
  methods: {
    changeAvatar(e) {
      this.avatar = e.target.files[0];
      let blob = new Blob();
      let blobFile = this.blobToFile(blob, e.target.files[0]);
      // this.file = blobFile.name
      // 'IMAGE.JPG'
      // console.log(blobFile.name.name);
      // ALTERNATIVE CAN USE E.TARGET.FILES[0]
      let image = blobFile.name;
      // CHECK IMAGE, IF EXISTS THEN SHOW BUTTON UPLOAD IMAGE
      this.checkFile = e.target.files[0];
      this.read(image);
    },
    read(image) {
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.image = e.target.result;
      }
    },
    // formSubmit() {

    // DEFINE FORM
    // let formAva = document.getElementById('formAva')

    // // GET IMAGE BLOB
    // let imageUrl = this.avatar

    // // SPLIT THE BASE64 STRING IN DATA AND CONTENTTYPE
    // let block = imageUrl.split(";");

    // // GET THE CURRENT TYPE
    // let contentType = block[0].split(":")[1]; // IN THIS CASE "IMAGE/JEPG"

    // // GET THE REAL BASE64 CONTENT OF THE FILE
    // let realData = block[1].split(",")[1]; // INTHIS CASE "iVBORw0KGg...."

    // // CONVERT TO BLOB
    // let blob = this.b64toBlob(realData, contentType);

    // // CREATE A FORMDATA AND APPEND THE FILE
    // let fd = new FormData(formAva);
    // fd.append("avatar", blob);

    // let vm = this;
    //
    // const config = {
    //   headers: {
    //     'content-type': 'multipart/form-data'
    //   }
    // }

    // let url = '/change_avatar/' + this.user_id + '/update';

    // axios.put(url, fd)
    //  .then((response) => {
    //   toastr.info('Successfully change ava!');
    //   location.reload();
    // }).catch((error) => {
    //   console.log(error.response)
    //   toastr.info('Something error happened!');
    // })
    // },
    // upload() {
    //   axios.put('/change_avatar/' + this.user_id + '/update', {
    //      formData
    //     }).then((response) => {
    //       toastr.info('Successfully change ava!');
    //       location.reload();
    //     }).catch((error) => {
    //       console.log(error.response)
    //       toastr.info('Something error happened!');
    //     })
    // },
    upload() {
      const formData = new FormData();
      formData.append('avatar', this.avatar, this.avatar.name)
      axios.post('/change-avatar/' + this.user_id + '/update', formData).then(response => {
        toastr.info('Successfully change ava!');
        location.reload();
      }).catch((error) => {
        console.log(error.response)
        toastr.info('Something error happened!');
      })
    },
    blobToFile(theBlob, fileName) {
      theBlob.lastModifiedDate = new Date();
      theBlob.name = fileName;
      return theBlob;
    },
    b64toBlob(b64Data, contentType, sliceSize) {
      contentType = contentType || '';
      sliceSize = sliceSize || 512;

      var byteCharacters = atob(b64Data);
      var byteArrays = [];

      for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
          byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
      }

      var blob = new Blob(byteArrays, {
        type: contentType
      });
      return blob;
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
