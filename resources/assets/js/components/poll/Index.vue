<template>
    <div>

        <div class="_columns _is_multiline _polls_in_mobile">
            <div v-for="poll in polls" :key="poll.id" class="_column _is_one_third" >
                    
                 <img  class="_img_emotions" :src="'/assets/emotions/'+ poll.question + '.png'">
                
                    <div v-for="option in poll.poll_options" :key="option.id">
                        <input type="radio" v-model="option_id" :value="option.id">    
                        <strong> {{ percentage(option) }} % </strong> <br>
                        <span>
                          Total : {{ option.total }}
                        </span>  
                    </div>


              </div>
            </div>

            <div class="_column">
              <a href="#!" class="_button" @click.prevent="submit">Vote!</a> 
            </div>

                    <!-- <div id="options" v-if="!data.isCookie">
                       <div class="radio" v-for="option in data.options" :key="option.id">
                         
                            <input type="radio" v-model="option_id" :value="option.id" @click="changeButton" name="option">
                            {{ option.name }}
                         
                        </div> 
                         <button :class="{'btn': true, 'btn-primary' : true, 'disabled' : !isChecked }" @click="submit">Vote!</button>
                    </div>
                    <div v-else>
                        <div class="radio" v-for="option in data.options" :key="option.id">
                          <label>
                          <strong>{{ percentage(option) }} % </strong> &nbsp; {{ option.name }}
                          </label>
                        </div> 
                    </div>
 
                    <div class="alert alert-success" v-show="message">
                            <p>{{ message }}</p>
                        </div> -->
                                           
     </div>
</template>
 
<script>
    export default {
        props:['blog_id'],
        data(){
            return {
                polls: [],
                data : [],
                option_id : 0,
                isChecked : false,
            }
        },
        computed:
        {
            totalVote()
            {
             let count = 0;  
                this.polls.forEach(function(poll){
                    poll.poll_options.forEach(function(option){
                        count += option.total;
                    })
                })
                return count;
            }
        },
       mounted()
       {
           this.getPolls() 
       },
       methods:{
            getPolls() {
                axios.get('/getPolls').then((res) => {
                    this.polls = res.data;
                }).catch((err) => {
                    console.log(err)
                })
            },
            submit()
            {
                
                axios.post('/polls',{'poll_option_id': this.option_id, 'blog_id': this.blog_id }).then((response) => {

                // this.data.isCookie = true;
                this.increment(this.option_id);

                }).catch((err) => {
                    console.log(err)
                });
        
            },
            increment(id)
            {
                this.polls.forEach(function(poll){
                    poll.poll_options.forEach(function(option) {
                        if(option.id == id)
                        {
                            option.total ++;
                        }
                    });
                });
            },
            percentage(option)
            {
                return Math.round(((option.total * 100) / this.totalVote ));
            }
       }
    }
</script>



<style lang="scss" scoped>
 ._img_emotions {
     width: 80px;
 }
</style>
