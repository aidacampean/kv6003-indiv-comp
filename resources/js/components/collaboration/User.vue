<template>
  <b-col>
    <div class="card align-center">
        <slot/>
    </div>
  </b-col>
</template>

<script>
  export default {
    // props: {
    //   user: {
    //     type: Array,
    //     default: [],
    //   }
    // },
    data() {
      return {
        errors: [],
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    },
  }
</script>
<style lang="scss" scoped>
  .card {
    max-width: 150px;
    //height: 50px;
    box-shadow: 1px 1px 2px 1px rgba(136, 136, 136, 0.8);/* offset-x | offset-y | blur-radius | spread-radius | color */
    border-radius: 2px 2px 2px;
    margin: 10px 0;
    vertical-align: middle;
    padding: 10px;
  }
</style>