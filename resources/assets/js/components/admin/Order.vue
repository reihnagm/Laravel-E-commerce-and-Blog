<template>
  <div>
      <div v-for="order in orders" :key="order.id">
          
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return  {
            orders: []
        }
    },
    computed: {

    },
    mounted() {
        axios.get('/api/orders').then((response) => {
            console.log(response.data)
           this.orders = response.data
        })
    },
    methods: {
        
    },
}
</script>

<style>

</style>
