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

      <!-- <tbody id="tbody_all"></tbody> -->
      <template v-for="order in orders">
        <tr>
          <template v-for="product in order.products">
            <td>{{ product.name }}</td>
            <td>{{ product.pivot.qty }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.user.username }}</td>
            <td>{{ product.pivot.total }}</td>
            <td> <input @change="status(order.delivered, order.id)" type="checkbox" v-model="order.delivered"> </td>
          </template>
        </tr>
      </template>

      <!-- <tbody>
          <tr id="list_orders_all">
            <td id="name_product"></td>
            <td id="qty"></td>
            <td id="price"></td>
            <td id="order_by"></td>
            <td id="total_price"></td>
            <td id="status_deliver"><input @change="status()" type="checkbox" v-model="delivered"> </td> 
          </tr>
        </tbody>
      -->
    </table>

    <!-- <component :is="test"></component> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      orders: [],
      name: "",
      qty: "",
      price: "",
      username: "",
      checked: "",
      delivered: ""
    };
  },
  created() {
    // let list_orders_all = document.getElementById("list_orders_all"),
    // name_product = document.getElementById("name_product"),
    // qty =  document.getElementById("qty"),
    // price = document.getElementById("price"),
    // order_by =  document.getElementById("order_by"),
    // total_price =  document.getElementById("total_price"),
    // status_deliver =  document.getElementById("status_deliver");
    // let tbody_all = document.getElementById("tbody_all");
  },
  mounted() {
    this.getOrder();
  },
  // computed: {
  //   test() {
  //     return {
  //       template:
  //       '<tr>'+
  //         '<td>'+ this.name + '</td>'+
  //         '<td>'+ this.qty + '</td>' +
  //         '<td>'+ this.price + '</td>' +
  //         '<td>'+ this.username + '</td>' +
  //         '<td>'+ this.total + '</td>' +
  //         '<td>'+ this.delivered+'</td>'+
  //       '</tr>',
  //       methods: {
  //         status() {
  //           alert('npm')
  //         }
  //       }
  //     }
  //   }
  // },
  methods: {
    async getOrder() {
      let content = "";
      await axios.get("/api/orders_index").then(response => {
        this.$nextTick(() => {
          this.orders = response.data;
          this.orders.forEach(order => {
            order.products.forEach(product => {
              this.name = product.name;
              this.qty = product.pivot.qty;
              this.total = product.pivot.total;
              this.price = product.price;
              this.username = product.user.username;
              this.delivered = order.delivered;

              //  name_product.textContent = this.name
              //  qty.textContent = this.qty
              //  price.textContent = this.price
              //  order_by.textContent = this.username
              //  total_price.textContent = this.total

              //  list_orders_all.appendChild(name_product)
              //  list_orders_all.appendChild(qty)
              //  list_orders_all.appendChild(price)
              //  list_orders_all.appendChild(order_by)
              //  list_orders_all.appendChild(total_price)
              //  list_orders_all.appendChild(status_deliver)

              // content +=
              //   "<tr>" +
              //   "<td>" +
              //   this.name +
              //   "</td>" +
              //   "<td>" +
              //   this.qty +
              //   "</td>" +
              //   "<td>" +
              //   this.price +
              //   "</td>" +
              //   "<td>" +
              //   this.username +
              //   "</td>" +
              //   "<td>" +
              //   this.total +
              //   "</td>" +
              //   "<td>" +
              //   this.delivered +
              //   "</td>" +
              //   "<td>" +
              //   `<button @click=test()> bom </button>` +
              //   "</td>" +
              //   "</tr>";

              // tbody_all.innerHTML = content;
            });
          });
        });
      }).catch((response) => {
        console.log(response)
      });
    },
    status(checkOrder, orderId) {
      if(checkOrder) {
        axios.post("/api/orders/toggle/delivered/" + orderId, {
          delivered: 1
        }).then(response => {
          console.log(response)
        }).catch((response) => {
          console.log(response)
        });
      } else {
          axios.post("/api/orders/toggle/delivered/" + orderId, {
          delivered: 0
        }).then(response => {
          console.log(response)
        }).catch((response) => {
          console.log(response)
        });
      }
    }
  }
};
</script>
