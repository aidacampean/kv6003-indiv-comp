<template>
  <div>
    <h2>{{ 'Trip to ' + trip.name }}</h2>
    <h5> {{ trip.date_from | formatDate }} to {{ trip.date_to | formatDate }}</h5>
    <hr>
    
    <b-row class="horizontal">
      <!-- <days v-for="(day, index) in days" :key="index" :type="trip" :id="day" /> -->
      <days
        v-for="(day, key, index) in trip.days"
        :key="key"
        :events="day"
        :date="key"
        :counter="index+1"
        :tripId="trip.id"
        class="content overflow-auto"
      />
    </b-row>
  </div>
</template>

<script>
  import Days from './Days.vue'

  export default {
    components: {
      'days': Days
    },
    props: {
      trip: {
        type: Object,
        default: () => []
      }
    },
    data() {
      return {
        form: {
          name: 'flight',
          bookingReference: '',
          date: ''
        },
        events: [
          {'name': 'Flights'},
          {'name': 'Hotels'},
          {'name': 'Excursions'},
          {'name': 'Other'}
        ]
      }
    }
  }

</script>

<style scoped>
  h2 {
    color: rgb(82, 79, 79);
  }

  h5 {
    color: #666;
    font-size: 0.9em;
  }

  .content {
    max-height: 300px;
  }
</style>