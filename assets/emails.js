import Vue from 'vue';
import EmailList from './components/EmailList';
import './styles/app.css';

// import {store} from './contact';

new Vue({
  el: '#emails',
  render: (h) => h(EmailList),
});
