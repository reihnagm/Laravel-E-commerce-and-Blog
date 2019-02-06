<template>
  <div>
    <table>
      <tr>
        <th>ID</th>
        <th>AVA</th>
        <th>USERNAME</th>
        <th>EMAIL</th>
        <th>DATE USER JOIN</th>
        <th>OPTION</th>
      </tr>
      <template v-for="user in users">
        <tr>
          <td>{{ user.id }}</td>
          <template v-if="user.avatar">
            <td>
              <img :src="user.avatar">
            </td>
          </template>
          <template v-else>
            <td>
              <v-gravatar :email="user.email"/>
            </td>
          </template>
          <!-- <td> <img :src="user.avatar">  </td> -->
          <td>{{ user.username.toUpperCase() }}</td>
          <td>{{ user.email.toUpperCase() }}</td>
          <td>{{ user.created_at.toUpperCase() | moment("dddd, MMMM Do YYYY") }}</td>
          <td>
            <a href="#!" @click.prevent="editUser(user)">EDIT</a> |
            <a href="#!" @click.prevent="deleteUser(user.id)">DELETE</a>
          </td>
        </tr>
      </template>
    </table>

    </tbody>
    <pie-chart :chart-data="datacollection"></pie-chart>
  
  </div>
</template>

<script>
import Bus from "../../bus";
import UserChart from "./chart/UserChart";

export default {
  props: ["users_data"],
  components: {
    "pie-chart": UserChart
  },
  data() {
    return {
      users: [],
      datacollection: null
    };
  },
  mounted() {
    this.getAllDataUsers();
    this.getStatisticUsers();
  },
  methods: {
    async getAllDataUsers() {
      await axios.get("/api/users_index").then(response => {
        this.$nextTick(() => {
          this.users = response.data;
        });
      });
    },
    getStatisticUsers() {
      this.datacollection = {
        labels: ["Total Users", "Users Online", "Users Offline"],
        datasets: [
          {
            backgroundColor: [
              "rgb(100, 160, 180)",
              "rgb(0, 255, 160)",
              "rgb(230, 0, 20)"
            ],
            data: [this.users_data, this.users_online, "10"]
          }
        ]
      };
    },
    editUser(users) {
      console.log(users);
    },
    deleteUser(userId) {
      console.log(userId);
    }
  }
};
// import LineChart from "./chart/LineChart.vue";
// export default {
// import { Bar } from 'vue-chartjs'
//   extends: Bar,
//    mounted() {
//   let years = new Array();
//   let labels = new Array();
//   axios.get("/api/users_all").then((response) => {
//       let data = response.data;
//       if(data) {
//           data.forEach(item => {
//             years.push(item.created_at)
//             labels.push(item.name)
//           });
//           this.renderChart({
//             label: years,
//             datasets:[{
//                 label: 'All Users',
//                 backgroundColor:'gray',
//             }]
//        }, { responsive: true, maintainAspectRatio: false})
//       }
//      else {
//          console.log('no data')
//      }
//   })
//   }
</script>
