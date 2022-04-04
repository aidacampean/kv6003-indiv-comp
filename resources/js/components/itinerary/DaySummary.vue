<template>
  <div class="summary">
    <div v-for="value in data" :key="value.id">
      {{ 'Event type: ' }} {{ value.name }}
      </div>
  </div>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: []
      }
    }
}
</script>