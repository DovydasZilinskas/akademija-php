import Vue from 'vue';
import Contact from './views/ContactForm';
import store from './store';
import './styles/app.css';

new Vue({
  el: '#app',
  store,
  render: (h) => h(Contact),
});
