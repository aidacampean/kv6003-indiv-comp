<template>
  <div class="summary">
    <div v-if="data.length == 0" class="p-4">
      There are no events
    </div>
    <div v-for="value in data" :key="value.id">
      <hr>
      <div class="p-3 mb-2 bg-dark-green text-white">
        <h5 >{{ 'EVENT TYPE: ' }} {{ value.name.toUpperCase() }}</h5>
      </div>
      <br>
      <h6 class="font-weight-bold">DESCRIPTION: </h6>
      <p>{{ value.description }}</p>
      <h6 class="font-weight-bold">NOTES: </h6>
      <p>{{ value.notes }}</p>
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