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
        v-b-tooltip.hover title="See day summary of events"
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
        default: () => {
          return {
            id: 0,
            user_id: 0,
            name: null,
            city_id: 0,
            date_from: "",
            date_to: "",
            days: []
          }
        },
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