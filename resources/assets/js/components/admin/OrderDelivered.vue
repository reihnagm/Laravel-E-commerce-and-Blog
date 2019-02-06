<template>
  <div>
    <table>
   
        <tr>
          <th>Name Product</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Order By</th>
          <th>Total Price</th>
          <th>Status</th>
        </tr>
  
        <tbody id="tbody_delivered">

        </tbody>
         
   </table>
  </div>
</template>

<script>


export default {
  data() {
    return {  
      name: "",
      qty: "",
      price: "",
      username: "",
      delivered: ""
    };
  },
  created() {
    let tbody_delivered = document.getElementById("tbody_delivered");
  },
  mounted() {
   this.getOrder()
  },
  methods: {
   async getOrder() {
       let content = "";
         await axios.get("/api/orders/delivered").
         then(response => {
           this.$nextTick(() => {
            this.orders = response.data;
            this.orders.forEach(order => {
              order.products.forEach(product => {
                this.name = product.name;
                this.qty = product.pivot.qty
                this.total = product.pivot.total
                this.price = product.price 
                this.username = product.user.username
                this.delivered = order.delivered

                  content += 
                  '<tr>' +
                    '<td>'+ this.name + '</td>'+
                    '<td>'+ this.qty + '</td>' +
                    '<td>'+ this.price + '</td>' +
                    '<td>'+ this.username + '</td>' +
                    '<td>'+ this.total + '</td>' +
                    '<td>'+ this.delivered +'</td>'+
                  '</tr>'

                  
                  tbody_delivered.innerHTML = content
            })
          });
        });

      });
    }
  }
};
</script>
