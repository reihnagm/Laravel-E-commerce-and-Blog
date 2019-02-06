<template>
<div>

  <div class="columns mobile-columns is-multiline">
    <div class="column mobile-column is-one-third" v-for="emotion in emotions" :key="emotion.id">

      <div class="emotions-bar-container">
        <span v-if="totalIsZero">
          <div class="emotions-bar" :style="{ height: '0px' }"></div>
        </span>
        <span v-else>
          <div class="emotions-bar" :style="{ height: parseInt(emotion.perTotal/total*100) + 'px' }"></div> <!--  v-bind:style="{ height: percentage + 'px' }" -->
        </span>
        <img @click.prevent="submit(emotion.id)" class="emotions-img" :src="'/assets/emotions/' + emotion.name + '.png'">
      </div>

      <span v-if="totalIsZero">
        <span class="emotions-total"> 0 % </span>
      </span>
      <span v-else>
        <span class="emotions-total"> {{ parseInt(emotion.perTotal/total*100) }} % </span>
      </span>
      <span class="emotions-percentage"> Total : {{ emotion.perTotal }} </span>

    </div>
  </div>

</div>
</template>

<script>
export default {
  props: ["blog_id"],
  data() {
    return {
      emotions: [{
          id: 1,
          name: "happy",
          perTotal: 0
        },
        {
          id: 2,
          name: "sad",
          perTotal: 0
        },
        {
          id: 3,
          name: "angry",
          perTotal: 0
        },
        {
          id: 4,
          name: "amazing",
          perTotal: 0
        },
        {
          id: 5,
          name: "fear",
          perTotal: 0
        },
        {
          id: 6,
          name: "doubt",
          perTotal: 0
        }
      ],
      total: 0,
      percentage: 0
    };
  },
  computed: {
    totalIsZero() {
      if (this.total != 0) {
        return false;
      }
      return true;
    },
  },
  created() {
    axios.get("/emotions/" + this.blog_id).then(response => {
      this.total = response.data.total;

      this.emotions.forEach(emotion => {
        switch (emotion.id) {
          case 1:
            emotion.perTotal = response.data.happy;
            break;
          case 2:
            emotion.perTotal = response.data.sad;
            break;
          case 3:
            emotion.perTotal = response.data.angry;
            break;
          case 4:
            emotion.perTotal = response.data.amazing;
            break;
          case 5:
            emotion.perTotal = response.data.fear;
            break;
          case 6:
            emotion.perTotal = response.data.doubt;
            break;
        }
      });

    });
  },
  methods: {
    submit(emotion_id) {
      axios
        .get("/emotions/" + emotion_id + "/" + this.blog_id)
        .then(response => {
          if (response.data.message == "vote") {
            this.total++;
            let index = this.emotions.findIndex(
              emotion => emotion.id === emotion_id
            );
            toastr.info('Successfully vote a blog!')
            this.emotions[index].perTotal++;
          }
          if (response.data.message == "unvote") {
            this.total--;
            let index = this.emotions.findIndex(
              emotion => emotion.id === emotion_id
            );
            toastr.info('Successfully cancel a vote!')
            this.emotions[index].perTotal--;
          }
          if (response.data.message == "changed") {
            toastr.info('Successfully updated a vote!')
            this.modify(response.data.old_emotion, -1);
            this.modify(emotion_id, 1);
          }
        }).catch((error) => {
          if (error.response.data.message = "Trying to get property of non-object") {
            toastr.info("You must Login before vote Emotions!");
          }
          console.log(error.response)
        });
    },
    modify(val, point) {
      let index = this.emotions.findIndex(emotion => emotion.id === val);

      switch (val) {
        case 1:
          this.emotions[index].perTotal = this.emotions[index].perTotal + point;
          break;
        case 2:
          this.emotions[index].perTotal = this.emotions[index].perTotal + point;
          break;
        case 3:
          this.emotions[index].perTotal = this.emotions[index].perTotal + point;
          break;
        case 4:
          this.emotions[index].perTotal = this.emotions[index].perTotal + point;
          break;
        case 5:
          this.emotions[index].perTotal = this.emotions[index].perTotal + point;
          break;
        case 6:
          this.emotions[index].perTotal = this.emotions[index].perTotal + point;
          break;
      }

    }
  }
};
</script>
