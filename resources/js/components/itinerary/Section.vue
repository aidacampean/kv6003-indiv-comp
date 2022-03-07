<template>
<div>
    <i :class="hide ? showIcon : hideIcon" @click="changeState();">Section</i>
    <div class="content" v-show="!hide">
      this is a test
    </div>
</div>
</template>

<script>
  export default {
    data() {
        return {
            hide: true,
            showIcon: 'fa-solid fa-angle-right',
            hideIcon: 'fa-solid fa-angle-down'
        }
    },
    methods: {
      changeState() {
        return this.hide = this.hide ? false : true;
      }
    }
  }
</script>

<style scoped>

 </style>