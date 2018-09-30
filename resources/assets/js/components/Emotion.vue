<template>
    <div>
    
          
           <div id="_emotions" class="clearfix" v-for="emotion in emotions" :key="emotion.id">

              <img style="float: left;" @click="vote(emotion.id)" :src="'assets/emotions/' + emotion.name + '.png'">  

                <span style="float: left; margin: 15px 0 0 10px; display: inline-block;"> 
                  0 %
                <div style="margin: 8px 0 0 0;">
                 {{ emotion.name }}
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
  props: ['blog_id', 'emotions'],
  data() {
    return {
      // emotions: [],
      //  totalEmotions: [],
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
      
        // let newTotal = []
        // Object.entries(this.emotions).forEach(([key, val]) => {
        //     newTotal.push(val.name)
        // });

        // return newTotal = this.totalEmotions

    },
  },
  mounted() {
   this.getEmotion()
   axios({
      url : '/emotion/' + this.blog_id,
      method: 'GET'
    }).then((res) => {
       if (res.total != 0 ) {
        this.total = res.data.total;
        this.happy = res.data.happy;
        this.sad = res.data.sad;
        this.amazing = res.data.amazing;
        this.doubt = res.data.doubt;
        this.fear = res.data.fear;
        this.angry = res.data.angry;
      }
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