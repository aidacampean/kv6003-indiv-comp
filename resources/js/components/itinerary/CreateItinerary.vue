<template>
  <div>
    <h2>{{ 'Trip to ' + trip.name }}</h2>
    <h5> {{ trip.date_from | formatDate }} to {{ trip.date_to | formatDate }}</h5>
    <hr>
    <b-row class="horizontal">
      <b-modal id="modal-1" size="lg" scrollable title="Add your details to the itinerary">
         <div >
      </div>
        <sections-itinerary v-for="(section, index) in sections" :key="section.name" :name="section.name"></sections-itinerary>
      </b-modal>
      <days v-for="(day, index) in days" :key="index" :type="trip" :id="day" />
    </b-row>
  </div>
</template>

<script>
  import Days from './Days.vue'
  import Section from './Section.vue'

export default {
  components: {
    'days': Days,
    'sections-itinerary': Section
  },
  props: {
    trip: {
      type: Object,
      default: () => []
    },
    days: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
     // totalDays: moment.diff(data.date_from)
      sections: [{ 'name': 'Flights'}, { 'name': 'Hotels'}]
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
</style>