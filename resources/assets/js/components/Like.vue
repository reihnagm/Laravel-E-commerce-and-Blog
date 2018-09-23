<template>

</template>

<script>
export default {

    props:["liked","modelid","modeltype"],
    
    data() {
        return {
          
        }
    },
    methods: {
    like() 
    {
        let url = "/like/" + this.modeltype + "/" + this.modelid
        axios.get(url,(res) =>{
        })
    }
  }

}
</script>

