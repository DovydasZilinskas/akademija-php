import Component from 'vue-class-component';
import Vue from 'vue';
import EmailList from '../components/EmailList.vue';

@Component({
  components: { Spinner, SpinnerSmall },
})
export default class EmailList extends Vue {
  data = [];
  loaded = false;
  timeout = null;
  orderby = '';
  order = '';
  polling = null;
  search = false;

  columns = [
    { name: 'name', order: 1 },
    { name: 'email', order: 1 },
    { name: 'message', order: 1 },
    { name: 'createdAt', order: 1 },
  ];

  sort(e) {
    const index = this.columns.map((x) => x.name).indexOf(e);
    this.orderby = e;
    this.columns[index].order = this.columns[index].order * -1;
    this.order =
      this.order === '' ? 'asc' : this.order === 'desc' ? 'asc' : 'desc';
    this.getEmails();
  }

  checkTyper() {
    const typer = document.getElementById('typer');
    typer.addEventListener('keyup', this.handleKeyUp());
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
      '/getemail?page=' +
        this.current +
        (this.searchName == '' ? '' : '&name=' + this.searchName) +
        (this.searchEmail == '' ? '' : '&email=' + this.searchEmail) +
        (this.searchMessage == '' ? '' : '&message=' + this.searchMessage) +
        (this.searchDateFrom == '' ? '' : '&datefrom=' + this.searchDateFrom) +
        (this.searchDateTo == '' ? '' : '&dateto=' + this.searchDateTo) +
        (this.orderby == '' ? '' : '&orderby=' + this.orderby) +
        (this.order == '' ? '' : '&order=' + this.order)
    )
      .then((r) =>
        r.json().then((data) => ({
          total: r.headers.get('totalItems'),
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
    if (confirm('Are you sure you want to delete this item?')) {
      fetch('/deleteemail/' + item.id, {
        method: 'DELETE',
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
      console.log('No delete');
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
    this.$store.commit('updateSearchName', value);
    this.checkTyper();
  }
  set searchMessage(value) {
    this.$store.commit('updateSearchMessage', value);
    this.checkTyper();
  }
  set searchEmail(value) {
    this.$store.commit('updateSearchEmail', value);
    this.checkTyper();
  }
  set searchDateFrom(value) {
    this.$store.commit('updateSearchDateFrom', value);
    this.checkTyper();
  }
  set searchDateTo(value) {
    this.$store.commit('updateSearchDateTo', value);
    this.checkTyper();
  }
  get current() {
    return this.$store.getters.getCurrentPage;
  }
  set current(value) {
    this.$store.commit('updatePage', value);
    this.checkTyper();
  }
  set pageCount(value) {
    this.$store.commit('updatePageCount', value);
  }
  get pageCount() {
    return this.$store.getters.getPageCount;
  }
}
