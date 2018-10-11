<template>
    <div>
      <div class="_columns _is_multiline">
        <div v-for="emotionlist in emotionslists" :key="emotionlist.id"  class="_column _is_one_third">
          <img width="80" :src="'/assets/emotions/' + emotionlist.name + '.png'" @click.prevent="vote(emotionlist.id)">
          
           Total : {{ emotionlist.name }}
      
        </div>
      </div>
    </div>
</template>

<script>

export default {
  props:['blog_id'],
  data() {
    return {
      emotionslists:[],
          total: 0,
          happy: 0,
          sad: 0,
          angry: 0
    }
  },
   computed: {
  
  },
  mounted() {
   this.getEmotionsLists()
   this.getEmotionsTotal()
  },
  methods: {
      getEmotionsLists() {
       axios.get('/emotionslists').then((res) => {
          this.emotionslists = res.data   
       
        }).catch((err) => {
          console.log(err)
        })
      },
       getEmotionsTotal() {    
            axios.get('/emotions/' + this.blog_id).then((res) => {
                console.log(res)
              if (res.data.total != 0 ) {
                this.total = res.data.total;
                this.happy = res.data.happy;
                this.sad = res.data.sad;
                this.angry = res.data.angry;
              }
            })
          },
       vote(emotion_id) {
          axios.get('/emotions' + '/emotion_id/' + emotion_id + '/blog_id/' + this.blog_id).then((res) => {
             if(res.data.message == 'vote') {
               this.total++;
              //  this.modify(emotionid, 1);
             } else if(res.data.message == 'unvote') {
               this.total--;
              //  this.modify(emotionid, -1)
             } else {
              //  this.modify(parseInt(res.data.old_emotion), -1);
              //  this.modify(emotionid, 1);
             }

          })
        },
      // modify(val, point) {
      //   switch (val) {
      //     case 1: this.happy = this.happy + point; break;
      //     case 2: this.sad = this.sad + point; break;
      //     case 3: this.amazing = this.amazing + point; break;
      //     case 4: this.doubt = this.doubt + point; break;
      //     case 5: this.fear = this.fear + point; break;
      //     case 6: this.angry = this.angry + point; break;
          
      //     default:
      //     break;
      //   }
      // },
      //  percentage(emotion)
      //     {
      //         return Math.round(((emotion.total * 100) / this.total ));
      //     }
     }
   }


</script>

<style scoped>


</style>