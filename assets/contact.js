import Vue from 'vue';
import Contact from './components/ContactForm';
import './styles/app.css';

new Vue({
  el: '#contact',
  render: (h) => h(Contact),
});
