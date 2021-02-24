<template>
  <div class="container">
    <h2>Contact me</h2>
    <form @submit.prevent="send">
      <label>Full Name</label>
      <input type="text" maxlength="255" v-model="name" placeholder="Name" />

      <label>Email</label>
      <input type="email" maxlength="255" v-model="email" placeholder="Email" />

      <label>Message</label>
      <textarea
        maxlength="255"
        v-model="emailMessage"
        placeholder="Your text here..."
      ></textarea>

      <vue-recaptcha
        class="g-recaptcha"
        ref="invisibleRecaptcha"
        @verify="onCaptchaVerified"
        @expired="onCaptchaExpired"
        :sitekey="sitekey"
        size="invisible"
      ></vue-recaptcha>

      <button type="submit" @click="spin = !spin">Send</button>
    </form>
    <NotificationsMsg
      v-if="error"
      v-bind:message="notificationsMsg"
      v-on:displaynot="error = false"
      :type="type"
    />
    <Spinner :start="spin" />
  </div>
</template>

<script>
import Vue from 'vue'
import Component from 'vue-class-component';
import NotificationsMsg from './Notification';
import VueRecaptcha from 'vue-recaptcha';
import Spinner from './Spinner';

@Component({
    components: {
    NotificationsMsg, VueRecaptcha, Spinner
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
      type: "",
      sitekey: "6Ld2MlUaAAAAABKG7ibjB5iZIXVDLBy_e5sSVLJq",
      spin: false,
    }
  }
  send() {
    this.$refs.invisibleRecaptcha.execute();
  }
  onCaptchaVerified(response) {
    this.$refs.invisibleRecaptcha.reset();
    fetch("/contactpost", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: JSON.stringify({
        fullName: this.name,
        email: this.email,
        message: this.emailMessage,
        captcha: response
        })
    })
    .then(res => res.json())
    .then(res => {
      if (Object.keys(res).length > 1 ) {
        this.error = true;
        this.$store.commit('error', 'blank.fields');
        this.notificationsMsg = this.$store.getters.messageToDisplay;
        this.type = "error";
        this.spin = false;
      } else if (Object.values(res) != "success" ) {
        this.error = true;
        this.$store.commit('error', Object.keys(res));
        this.notificationsMsg = this.$store.getters.messageToDisplay;
        this.type = "error";
        this.spin = false;
      } else {
        this.error = true;
        this.$store.commit('success', Object.values(res));
        this.notificationsMsg = this.$store.getters.messageToDisplay;
        this.email = "";
        this.name = "";
        this.emailMessage = "";
        this.type = "";
        this.spin = false;
      }
    })
    .catch(error => console.log(error))
  }
  onCaptchaExpired() {
    this.$refs.invisibleRecaptcha.reset();
  }
}

</script>

<style scoped>
.container {
  margin: 0 auto;
  width: 323px;
  background-color: #f2ede9;
  padding: 20px;
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

input,
textarea {
  margin-bottom: 10px;
}

.error {
  background: #f16157;
}

@media only screen and (max-width: 376px) {
  .container {
    width: 230px;
  }
}
</style>

