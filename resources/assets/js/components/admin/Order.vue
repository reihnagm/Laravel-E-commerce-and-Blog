<template>
  <div>
      <br>
      <a href="#!" @click.prevent="component='order-all'">All Orders</a> /
      <a href="#!" @click.prevent="component='order-pending'">Pending Orders</a> /
      <a href="#!" @click.prevent="component='order-delivered'">Delivered Orders</a>
      <!-- <input @change="status()" type="checkbox" id="checkbox" v-model="checked">
      <label for="checkbox"> {{ checkedStatus }} </label> -->
      <br>
      <br>
      <component :is="component"></component>
  </div>
</template>
 
<script>
import OrderAll from "./OrderAll";
import OrderPending from "./OrderPending";
import OrderDelivered from "./OrderDelivered";

export default {
  components: {
    "order-all": OrderAll,
    "order-pending": OrderPending,
    "order-delivered": OrderDelivered
  },
  methods: {
    status() {
     if(this.checked) {
        this.checkedStatus = "Delivered"
        // axios.post("/api/orders/toggle/delivered/" + this.orderId, {
        //     checked : this.checked 
        // })
     }else {
       !this.checked 
        this.checkedStatus = "Cancel delivered"
     } 
   },
  },
  data() {
    return {
      checked: "",
      checkedStatus:"",
      component: "order-all"
    };
  }
};
</script>


