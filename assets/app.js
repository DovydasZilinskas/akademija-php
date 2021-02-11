import Vue from 'vue';
import Contact from './components/ContactForm';
import './styles/app.css';

import {store} from './contact';

new Vue({
  el: '#app',
  store,
  render: (h) => h(Contact),
});
