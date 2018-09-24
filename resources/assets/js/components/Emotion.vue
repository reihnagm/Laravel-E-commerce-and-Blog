<template>
    <div>
    
          
           <div id="_emotions" class="clearfix">

              <img style="float: left;" @click="vote(emotion_id)" :src="'assets/emotions/' + emotion_name + '.png'">  

                <span style="float: left; margin: 15px 0 0 10px; display: inline-block;"> 
                  0 %
                <div style="margin: 8px 0 0 0;">
                 {{ emotion_name }}
                </div> 
               </span>
  
             
                <span style="float: left; margin: 15px 0 0 10px; display: inline-block;">
             
                  <div style="margin: 8px 0 0 0;">
                  
                  </div> 
               </span>            
              
            </div>
        
    
    </div>
</template>

<script>

export default {
  props:['emotion_id','emotion_name','blog_id'],
  data() {
    return {
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
    totalIsZero: function() {
    },
  },
  mounted() {
  this.getEmotion()
  },
  created() {
   axios({
      url : '/emotion/' + this.blog_id,
      method: 'GET'
    }).then(function(response) {
        let res = response.data;
        this.total = res.total;
        this.happy = res.happy;
        this.sad = res.sad;
        this.amazing = res.amazing;
        this.doubt = res.doubt;
        this.fear = res.fear;
        this.angry = res.angry;
    }).catch((err) => {
      console.log(err)
    })
  },
  methods: {
    getEmotion() {
    axios.get('/emotion').then((res) => {
      this.emotions = res.data
    }).catch((err) => {
      console.log(err)
    })
    },
     vote(emotionid) {
          this.$http({
            url: '/emotion/emotionid/' + emotionid + '/blogid/' + this.blog_id,
            method: 'GET'
          }).then(function(response) {
             res = response.data
        
             if(res.message == 'success') {
               this.total++;
               this.modify(emotionid, 1);
             } else if(res.message == 'unvote') {
               this.total--;
               this.modify(emotionid, -1)
             } else {
               this.modify(parseInt(res.old_emotion), -1);
               this.modify(emotionid, 1);
             }

          })
        },
      modify(val, point) {
        switch (val) {
          case 1: this.happy = this.happy + point; break;
          case 2: this.sad = this.sad + point; break;
          case 3: this.amazing = this.amazing + point; break;
          case 4: this.doubt = this.doubt + point; break;
          case 5: this.fear = this.fear + point; break;
          case 6: this.angry = this.angry + point; break;
          
          default:
          break;
        }
      }
   }
}

</script>

<style scoped>


</style>