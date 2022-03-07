<template>
  <div class="day-col">
    <header>
      <slot name="header" />
    </header>
    <main>
      <slot />
    </main>


    <button class="add-event" v-b-modal.modal-1>
      + Add
    </button>
  </div>
</template>

<script>
  export default {
    name:"DayTest",
    props: {
      data: {
        type: Object,
        default: () => []
      }
    },
    data() {
      return {
          
      }
    }
  }
</script>

<style scoped>
  .day-col {
  }

  .add-event {
    border: 0;
    margin-top:10px;
    padding: 5px;
    text-align: center;
    background-color: rgb(240, 238, 238);
    color: #999;
    width: 100%;
  }
</style>