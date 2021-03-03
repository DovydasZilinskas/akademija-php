import Vue from 'vue';
import EmailList from './components/EmailList';
import './styles/app.css';
import store from './store';

new Vue({
  el: '#emails',
  store,
  render: (h) => h(EmailList),
});
