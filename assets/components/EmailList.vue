<template>
  <div class="wrapper">
    <div class="ifloaded" v-if="loaded">
      <span>Page: {{ current }} of {{ pageCount }}</span>
      <table>
        <tr>
          <th>Email</th>
          <th>Full Name</th>
          <th>Message</th>
          <th>Actions</th>
        </tr>
        <tr v-for="item in paginated" :key="item.id">
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
    <nav v-else>
      <Spinner :start="spin" />
    </nav>
  </div>
</template>

<script>
import Vue from "vue";
import Component from "vue-class-component";
import Spinner from "./Spinner";

@Component({
  components: { Spinner }
})
export default class EmailList extends Vue {
  current = 1;
  pageSize = 10;
  data = [];
  spin = true;
  loaded = false;
  pageCount = "";

  mounted() {
    fetch("/getemail")
      .then(res => res.json())
      .then(res => {
        this.data = res;
        this.spin = false;
        this.loaded = true;
        this.pageCount = Math.ceil(res.length / this.pageSize);
      })
      .catch(error => console.log(error));
  }
  deleteItem(item) {
    if (confirm("Are you sure you want to delete this item?")) {
      fetch("/deleteemail/" + item.id, {
        method: "DELETE"
      })
        .then(() => {
          this.data.splice(this.data.indexOf(item.id), 1);
        })
        .catch(error => console.log(error));
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

.ifloaded {
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>