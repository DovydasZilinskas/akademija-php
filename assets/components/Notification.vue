<template>
   <div class="notification">
      {{message}}
      <span class="close" @click="close">&times;</span>
   </div>
</template>

<script>
   export default {
      name: 'Notification',
      props: ['message'],
      methods: {
         close() {
            this.$emit("displaynot");
         },
      },
   }
</script>

<style scoped>
.notification {
   border: 1px dotted #fff;
   padding: 5px;
   background: #F2EDE9;
   border-radius: 5px;
}

  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }


</style>