<template>
  <div class="email-container">
    <div class="ifloaded" v-if="loaded">
      <div class="page-count">
        <SpinnerSmall :load="search" />
        <span v-if="!search">Page: {{ current }} of {{ pageCount }}</span>
      </div>
      <table>
        <tr>
          <th>
            <div class="input-search">
              <input
                id="typer"
                type="text"
                v-model="searchEmail"
                placeholder="Search email.."
              />
            </div>
          </th>
          <th>
            <div class="input-search">
              <input
                id="typer"
                type="text"
                v-model="searchName"
                placeholder="Search name.."
              />
            </div>
          </th>
          <th>
            <div class="input-search">
              <input
                id="typer"
                type="text"
                v-model="searchMessage"
                placeholder="Search message.."
              />
            </div>
          </th>
          <th>
            <div class="input-search">
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
            </div>
          </th>
          <th></th>
        </tr>
        <tr>
          <th>
            <div class="title-flex">
              Email<a
                href="#"
                class="sort"
                :class="columns[1].order > 0 ? 'asc' : 'desc'"
                @click="sort('email')"
              ></a>
            </div>
          </th>
          <th>
            <div class="title-flex">
              Full Name<a
                href="#"
                class="sort"
                :class="columns[0].order > 0 ? 'asc' : 'desc'"
                @click="sort('name')"
              ></a>
            </div>
          </th>
          <th>
            <div class="title-flex">
              Message<a
                href="#"
                class="sort"
                :class="columns[2].order > 0 ? 'asc' : 'desc'"
                @click="sort('message')"
              ></a>
            </div>
          </th>
          <th>
            <div class="title-flex">
              Creation Date<a
                href="#"
                class="sort"
                :class="columns[3].order > 0 ? 'asc' : 'desc'"
                @click="sort('createdAt')"
              ></a>
            </div>
          </th>
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
        <input type="text" v-model="current" placeholder="Jump to page" />
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
import SpinnerSmall from "./SpinnerSmall";

@Component({
  components: { Spinner, SpinnerSmall },
})
export default class EmailList extends Vue {
  data = [];
  loaded = false;
  timeout = null;
  orderby = "";
  order = "";
  polling = null;
  search = false;
  columns = [
    { name: "name", order: 1 },
    { name: "email", order: 1 },
    { name: "message", order: 1 },
    { name: "createdAt", order: 1 },
  ];

  sort(e) {
    const index = this.columns.map((x) => x.name).indexOf(e);
    this.orderby = e;
    this.columns[index].order = this.columns[index].order * -1;
    this.order =
      this.order === "" ? "asc" : this.order === "desc" ? "asc" : "desc";
    this.getEmails();
  }

  checkTyper() {
    const typer = document.getElementById("typer");
    typer.addEventListener("keyup", this.handleKeyUp());
  }

  handleKeyUp() {
    window.clearTimeout(this.timeout);
    this.timeout = window.setTimeout(() => {
      this.search = true;
      this.getEmails();
    }, 1000);
  }

  getEmails() {
    fetch(
      "/getemail?page=" +
        this.current +
        (this.searchName == "" ? "" : "&name=" + this.searchName) +
        (this.searchEmail == "" ? "" : "&email=" + this.searchEmail) +
        (this.searchMessage == "" ? "" : "&message=" + this.searchMessage) +
        (this.searchDateFrom == "" ? "" : "&datefrom=" + this.searchDateFrom) +
        (this.searchDateTo == "" ? "" : "&dateto=" + this.searchDateTo) +
        (this.orderby == "" ? "" : "&orderby=" + this.orderby) +
        (this.order == "" ? "" : "&order=" + this.order)
    )
      .then((r) =>
        r.json().then((data) => ({
          total: r.headers.get("totalItems"),
          body: data,
        }))
      )
      .then((obj) => {
        this.data = obj.body;
        this.loaded = true;
        this.search = false;
        this.pageCount = Math.ceil(obj.total / 10);
      })
      .catch((error) => console.log(error));
  }

  created() {
    this.getEmails();
  }

  beforeDestroy() {
    clearInterval(this.polling);
  }

  deleteItem(item) {
    if (confirm("Are you sure you want to delete this item?")) {
      fetch("/deleteemail/" + item.id, {
        method: "DELETE",
      })
        .then(() => {
          this.data.splice(
            this.data.map((item) => item.id).indexOf(item.id),
            1
          );
          this.getEmails();
        })
        .catch((error) => console.log(error));
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
  get searchDateFrom() {
    return this.$store.getters.getCurrentSearchDateFrom;
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
  get current() {
    return this.$store.getters.getCurrentPage;
  }
  set current(value) {
    this.$store.commit("updatePage", value);
    this.checkTyper();
  }
  set pageCount(value) {
    this.$store.commit("updatePageCount", value);
  }
  get pageCount() {
    return this.$store.getters.getPageCount;
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

.sort {
  color: #595143;
  text-decoration: none;
  font-size: 1.4em;
}

.title-flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

input {
  width: 100%;
  margin-bottom: 0;
}

.input-search {
  display: flex;
  align-items: center;
}

.page-count {
  height: 80px;
}

.asc:before {
  content: "\2191";
}

.desc:before {
  content: "\2193";
}
</style>