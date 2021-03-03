import Vue from 'vue'
import Vuex from 'vuex'
import contact from './modules/contact'
import email from './modules/email'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    contact,
    email
  }
})