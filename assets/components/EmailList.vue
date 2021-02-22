<template>
  <div class="wrapper">
    <span>Page: {{ current }}</span>
    <table>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Full Name</th>
        <th>Message</th>
        <th>Actions</th>
      </tr>
      <tr v-for="item in paginated" :key="item.id">
        <td>{{ item.id }}</td>
        <td>{{ item.email }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.message }}</td>
        <td><button @click.prevent="deleteItem(item)">Delete</button></td>
      </tr>
    </table>
    <nav>
      <a @click="prev()">Prev</a>
      <a @click="next()">Next</a>
    </nav>
  </div>
</template>

<script>
import Vue from 'vue'
import Component from 'vue-class-component';

@Component
export default class EmailList extends Vue {
  data() {
    return {
      current: 1,
      pageSize: 10,
      data: [],
      newData: []
    }
  }
  retrieveData() {
    fetch("/getemail")
      .then(res => res.json())
      .then(res => {
          this.data = res;
        })
      .catch(error => console.log(error)) 
  }
  retrieveNewData() {
      fetch("/getemail")
      .then(res => res.json())
      .then(res => {
          this.newData = res;
        })
      .catch(error => console.log(error)) 
  }
  mounted() {
    this.retrieveNewData();
    setInterval(() => {
      if (this.data = this.newData) {
        this.retrieveNewData();
        console.log("No new data");
      } else {
        this.retrieveData();
      }     
    }, 3000);
  }
  deleteItem(item) {
    if (confirm("Are you sure you want to delete this item?")) {
    fetch("/deleteemail/" + item.id, {
      method: "DELETE"
    }).then(res => {
      this.data.splice(this.data.indexOf(item.id), 1)
      })
      .catch(error => console.log(error))
    } else {
      console.log("No delete");
    }
  }
  prev() {
    if (this.current >= 2) {
    this.current--;
    }
  }
  next() {
    this.current++;
  }
  get paginated() {
      return this.data.slice(this.indexStart, this.indexEnd);
  }
  get indexStart() {
      return (this.current - 1) * this.pageSize;
  }
  get indexEnd() {
      return this.indexStart + this.pageSize;
  }
  // beforeDestroy () {
  //   clearInterval(this.polling);
  // }
  // created(){
  //   this.retrieveData();
  // }
}
</script>

<style scoped>
nav {
  display: flex;
  justify-content: center;
  align-items: center;
}

nav a {
  font-weight: bold;
  cursor: pointer;
}
</style>