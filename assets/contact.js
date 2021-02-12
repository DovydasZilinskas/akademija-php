import Vue from 'vue';
import Vuex from 'vuex'
import './styles/app.css';

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    notificationsMessages: [
      { key: "success", notification: "Message has been sent"},
      { key: "error", notification: "Server error!"},
      { key: "data.fullName", notification: "Name field should not be blank."},
      { key: "data.email", notification: "Email field should not be blank."},
      { key: "data.message", notification: "Message field should not be blank."},
      { key: "blank.fields", notification: "Please fill blank fields."},
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
