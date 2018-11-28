<template>
 <div>

  <div class="_mobile_columns _is_multiline">
    <div class="_mobile_column _is_one_third" v-for="emotion in emotions" :key="emotion.id"> 
        <img  @click.prevent="submit(emotion.id)" class="_emotions_img" :src="'/assets/emotions/' + emotion.name + '.png'">
        <span v-if="totalIsZero">
           <span class="_emotions_total"> 0 % </span>
        </span>
        <span v-else>
           <span class="_emotions_total">  {{ parseInt(emotion.perTotal/total*100) }} % </span>
        </span>
        <span class="_emotions_percentage"> Total : {{ emotion.perTotal }} </span> 
      
    </div>
  </div>

 </div>
</template>
 
<script>
export default {
  props: ["blog_id"],
  data() {
    return {
      emotions: [
        {
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
      total: 0
    };
  },
  computed: {
    totalIsZero() {
      if (this.total != 0) {
        return false;
      }
      return true;
    }
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
            this.emotions[index].perTotal++;
            // this.modify(emotion_id, 1);
          }
          if (response.data.message == "unvote") {
            this.total--;
            let index = this.emotions.findIndex(
              emotion => emotion.id === emotion_id
            );
            this.emotions[index].perTotal--;
          }
          if (response.data.message == "changed") {
            this.modify(response.data.old_emotion, -1);
            this.modify(emotion_id, 1);
            // this.total--
            // let index = this.emotions.findIndex(emotion => emotion.id === emotion_id);
            // this.emotions[index].perTotal++
          }
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