<template>
  <div class="wrapper">
    <h2>Contact me</h2>
    <div id="contact-form-holder" ref="form"></div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    async mounted() {
        const data = await axios.get('/contactpost');
        console.log(data);
        this.$refs.form.innerHTML = data.data.form.content;
    }
}
</script>

<style scoped>
.wrapper {
  display: flex;
  justify-content: center;
}
</style>
