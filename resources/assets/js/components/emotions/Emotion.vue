<template>
    <div>
      <div class="_mobile_columns _is_multiline">
        <div v-for="emotionlist in emotionslists" :key="emotionlist.id"  class="_mobile_column _is_one_third">
          <img width="80" :src="'/assets/emotions/' + emotionlist.name + '.png'" @click.prevent="vote(emotionlist.id)">
          
           Total : {{ emotionlist.name }}

           {{ total }}

            {{ test }}
        </div>
      </div>
    </div>
</template>

<script>

export default {
  props:['blog_id'],
  data() {
    return {
    emotionslists:[{
      'id':'0',
      'name': 'happy'
     },
     {
      'id':'1',
      'name': 'sad'
     },
     {
      'id':'2',
      'name': 'angry'
     },
     {
      'id':'3',
      'name': 'amazing'
     },
     {
      'id':'4',
      'name': 'fear'
     },
     {
      'id':'5',
      'name': 'doubt'
     }],
       total: 0,
       happy: 0,
       sad: 0,
       amazing: 0,
       doubt: 0,
       fear: 0,
       angry: 0,
    }
  },
   computed: {
     test() {
     }
  },
  mounted() {

  },
  created: function () {    
    axios.get('/emotions/' + this.blog_id).then((res) => {
      if (res.data.total != 0 ) {
        this.total = res.data.total;
        this.happy = res.data.happy;
        this.sad = res.data.sad;
        this.amazing = res.data.amazing;
        this.doubt = res.data.doubt;
        this.fear = res.data.fear;
        this.angry = res.data.angry;
      }
    })
  },
  methods: {
       vote(emotion_id) {
          axios.get('/emotions' + '/emotionid/' + emotion_id + '/blogid/' + this.blog_id).then((res) => {
             if(res.data.message == 'vote') {
               this.total++;
               this.modify(emotion_id, 1);
             } else if(res.data.message == 'unvote') {
               this.total--;
               this.modify(emotion_id, -1)
             } else {
               this.modify(parseInt(res.data.old_emotion), -1);
               this.modify(emotion_id, 1);
             }
          })
        },
        modify(val, point) {
        switch (val) {
          case 0: this.happy += point; break;
          case 1: this.sad += point; break;
          case 2: this.angry += point; break;
          case 3: this.amazing += point; break;
          case 4: this.fear += point; break;
          case 5: this.doubt += point; break;
          
          default:
          break;
        }
      }

     }
   }


</script>

<style scoped>


</style>