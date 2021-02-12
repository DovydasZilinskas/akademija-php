<template>
  <div class="notification" v-bind:class="type">
    {{ message }}
    <span class="close" @click="close">&times;</span>
  </div>
</template>

<script>
   export default {
      name: 'Notification',
      props: {
        message: String,
        type: String,
      },
      methods: {
         close() {
            this.$emit("displaynot");
         },
      },
   }
</script>

<style scoped>
.notification {
  margin-top: 30px;
  border: 1px solid #fff;
  padding: 5px;
  background: #f2e2c4;
  border-radius: 10px;
  display: flex;
  align-items: center;
  padding-left: 20px;
}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-left: 10px;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>