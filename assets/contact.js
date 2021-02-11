import Vue from 'vue';
import Vuex from 'vuex'
import './styles/app.css';

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    notificationsMessages: [
      { key: "success", notification: "Message has been sent"},
      { key: "error", notification: "Please try again"},
   ],
   chosenMessage: '',
  },
  mutations: {
    success(state, key){
      const msgResult = state.notificationsMessages.find(msg => {
         return msg.key == key;
      });
      state.chosenMessage = msgResult.notification;
   },
   error(state, key){
      const msgResult = state.notificationsMessages.find(msg => {
         return msg.key == key;
      });
      state.chosenMessage = msgResult.notification;
   },
  },
  getters: {
    messageToDisplay(state){
        return state.chosenMessage;
    }
  },
});
