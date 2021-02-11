<template>
  <div class="container">
    <h2>Contact me</h2>
    <form v-on:submit.prevent="send">
      <label>Full Name</label>
      <input type="text" v-model="name" placeholder="Name" />

      <label>Email</label>
      <input type="email" v-model="email" placeholder="Email" />

      <label>Message</label>
      <textarea v-model="emailMessage" placeholder="Your text here..."></textarea>

      <button type="submit">Send</button>
    </form>
    <NotificationsMsg v-if="error" v-bind:message="notificationsMsg" v-on:displaynot="error = false" />
  </div>
</template>

<script>
import Vue from 'vue'
import Component from 'vue-class-component';
import NotificationsMsg from './Notification'
import axios from 'axios';

@Component({
    components: {
    NotificationsMsg
  },
})
export default class Contact extends Vue {
  data() {
    return {
      email: "",
      name: "",
      emailMessage: "",
      notificationsMsg: "",
      error: false,
    }
  }
  send() {
    axios.post('/contactpost', {
        fullName: this.name,
        email: this.email,
        message: this.emailMessage,
      })
      .then((response) => {
        if (response.data.data === 'success') {
          let key = 'success';
          this.$store.commit('success', key);
          this.notificationsMsg = this.$store.getters.messageToDisplay;
          this.error = true;
          this.email = "";
          this.name = "";
          this.emailMessage = "";
          console.log(this.$store.state.chosenMessage);
        } else {
          let key = 'error';
          this.$store.commit('error', key);
          this.notificationsMsg = this.$store.getters.messageToDisplay;
          this.error = true;
          console.log(this.$store.state.chosenMessage);
        }
      })
      .catch((error) => {
        console.log(error);
      })
  }
}
</script>

<style scoped>
.container {
    margin: 0 auto;
    width: 323px;
    background-color: #F2EDE9;
    padding: 50px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.form {
    display: flex;
    justify-content: center;
    flex-direction: column;
}

input {
    padding: 2px;
    width: 100%;
    box-sizing: border-box;
}

label {
  margin-top: 10px;
  font-weight: bold;
}

textarea {
    resize: vertical;
    width: 100%;
    box-sizing: border-box;
}

</style>
