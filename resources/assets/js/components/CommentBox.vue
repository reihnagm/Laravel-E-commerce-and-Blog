<template>
  <div>

    <div class="_column">
        <div id="_userComment">
            <img id="_imgComment" src="https://picsum.photos/200">
                 {{ username }}
            <div id="_descComment">
                <div> 
                 {{ subject }}
                </div>
                <div id="_optionLikeUnlike">  
                    <a id="_like" @click.prevent="likeIt(comment_id)" href="#!">  </a>               
                {{ likeCount }}
                    <a id="_unlike" @click.prevent="unlikeIt(comment_id)" href="#!"> </a>  
                {{ unlikeCount }}
                </div> 
            </div>
        </div>
     </div>
              
   </div>
</template>


<script>
 import Bus from '../bus'
 export default {
     props: ['username','subject','like', 'unlike', 'user_id', 'blog_id', 'comment_id'],
     data() {
         return {
             likeCount:0,
             unlikeCount:0,
         }
     },
     created() {
        this.likeCount = this.like
        this.unlikeCount = this.unlike
     },
     methods: {
         likeIt(commentId) {
          axios({
            url: '/like/' + commentId + '/2',
            method: 'GET'
          }).then((res) => {
             if(res.data.message === 'like')
             this.likeCount += 1
             else if(res.data.message === 'unlike')
             this.likeCount -= 1
          }).catch((res) => {
              console.log(res)
          })
         },
         unlikeIt(commentId) {
          axios({
            url: '/unlike/' + commentId + '/2',
            method: 'GET'
          }).then((res) => {
             if(res.data.message === 'unlike')
             this.unlikeCount += 1
             else if(res.data.message === 'cancelUnlike')
             this.unlikeCount -= 1
          }).catch((res) => {
              console.log(res)
          })
         },
   }
 }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    ._textareaComment {
        color: grey;
    }
    ._textareaComment:focus,
    ._textareaComment:hover {
        outline: none;
        border: 1px solid rgba(37, 37, 37, 0.7); 
    }
    #_wrapperComment {
        margin: 25px 0;
        color: grey;
    }
    #_imgComment {
        float: left; 
        margin: 0 5px 8px 0;
        width: 80px;
    }
    #_descComment {
        width: 70%;
        margin-bottom: 16px;
        line-height: 25px;
        word-break: break-all;
        text-align: justify;
    }
    #_optionCommentBtn {
        clear: both;
        display: inline-block;
        margin: 5px 0;
    }
    #_optionLikeUnlike {
        float: left;
    }
</style>