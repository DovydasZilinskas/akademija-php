<template>
  <div class="email-container">
    <div class="ifloaded" v-if="loaded">
      <span>Page: {{ current }} of {{ pageCount }}</span>
      <table>
        <tr>
          <th>
            <input
              id="typer"
              type="text"
              v-model="searchEmail"
              placeholder="Search email.."
            />
          </th>
          <th>
            <input
              id="typer"
              type="text"
              v-model="searchName"
              placeholder="Search name.."
            />
          </th>
          <th>
            <input
              id="typer"
              type="text"
              v-model="searchMessage"
              placeholder="Search message.."
            />
          </th>
          <th class="input-date">
            <input
              id="typer"
              type="text"
              v-model="searchDateFrom"
              placeholder="Date from"
            />
            <input
              id="typer"
              type="text"
              v-model="searchDateTo"
              placeholder="Date to"
            />
          </th>
          <th></th>
        </tr>
        <tr>
          <th>Email</th>
          <th>Full Name</th>
          <th>Message</th>
          <th>Creation Date</th>
          <th>Actions</th>
        </tr>
        <tr v-for="item in paginated" :key="item.id">
          <td>{{ item.email }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.message }}</td>
          <td>
            {{ item.createdAt.slice(0, 10) }}
            {{ item.createdAt.slice(11, 19) }}
          </td>
          <td><button @click.prevent="deleteItem(item)">Delete</button></td>
        </tr>
      </table>
      <nav>
        <a @click="prev()">Prev</a>
        <a @click="next()">Next</a>
      </nav>
    </div>
    <nav v-else>
      <Spinner :start="true" />
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
  loaded = false;
  pageCount = "";
  timeout = null;

  checkTyper() {
    const typer = document.getElementById("typer");
    typer.addEventListener("keyup", this.handleKeyUp());
  }

  handleKeyUp() {
    window.clearTimeout(this.timeout);
    this.timeout = window.setTimeout(() => {
      this.getEmails();
    }, 1000);
  }

  getEmails() {
    fetch(
      "/getemail?page=" +
        this.current +
        "&name=" +
        this.searchName +
        "&email=" +
        this.searchEmail +
        "&message=" +
        this.searchMessage
      // "&datefrom=" +
      // this.searchDateFrom +
      // "&dateto=" +
      // this.searchDateTo
    )
      .then(r =>
        r
          .json()
          .then(data => ({ total: r.headers.get("totalItems"), body: data }))
      )
      .then(obj => {
        this.data = obj.body;
        this.loaded = true;
        this.pageCount = Math.ceil(obj.total / this.pageSize);
      })
      .catch(error => console.log(error));
  }

  mounted() {
    this.getEmails();
  }

  deleteItem(item) {
    if (confirm("Are you sure you want to delete this item?")) {
      fetch("/deleteemail/" + item.id, {
        method: "DELETE"
      })
        .then(() => {
          this.data.splice(this.data.map(item => item.id).indexOf(item.id), 1);
        })
        .catch(error => console.log(error));
    } else {
      console.log("No delete");
    }
  }

  prev() {
    if (this.current >= 2) {
      this.current--;
      this.getEmails();
      this.loaded = false;
    }
  }

  next() {
    this.current++;
    this.getEmails();
    this.loaded = false;
  }

  get paginated() {
    return this.data;
  }

  get searchName() {
    return this.$store.getters.getCurrentSearchName;
  }
  get searchEmail() {
    return this.$store.getters.getCurrentSearchEmail;
  }
  get searchMessage() {
    return this.$store.getters.getCurrentSearchMessage;
  }
  get searchDateFrom() {
    return this.$store.getters.getCurrentDateFrom;
  }
  get searchDateTo() {
    return this.$store.getters.getCurrentSearchDateTo;
  }
  set searchName(value) {
    this.$store.commit("updateSearchName", value);
    this.checkTyper();
  }
  set searchMessage(value) {
    this.$store.commit("updateSearchMessage", value);
    this.checkTyper();
  }
  set searchEmail(value) {
    this.$store.commit("updateSearchEmail", value);
    this.checkTyper();
  }
  set searchDateFrom(value) {
    this.$store.commit("updateSearchDateFrom", value);
    this.checkTyper();
  }
  set searchDateTo(value) {
    this.$store.commit("updateSearchDateTo", value);
    this.checkTyper();
  }
}
</script>

<style scoped>
.email-container {
  background-color: #f2ede9;
  padding: 50px;
  border-radius: 5px;
}

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