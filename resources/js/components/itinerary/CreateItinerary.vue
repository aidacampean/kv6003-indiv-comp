<template>
  <div>
    <h2>{{ 'Trip to ' + data.name }}</h2>
    <h5> {{ data.date_from | formatDate }} to {{ data.date_to | formatDate }}</h5>
    <hr>
    <!-- <b-card class="primary-card"> 
      <b-card class="secondary-card">
        <h2>{{ data.name }}</h2>
        <hr>

        <b-card-title class="display-5 text-center">{{ 'Trip to ' + data.name }}</b-card-title>
        <hr>
        <b-card-text  class="">
          <strong>Departure date:</strong> {{ data.date_from | formatDate }}
        </b-card-text>

        <b-card-text  class="">
          <strong>Arrival date:</strong> {{ data.date_to | formatDate }}
        </b-card-text>
      </b-card>
    
    </b-card>

    <section-itinerary />
    <add-event /> -->


    <div class="day-row">
      <!-- <day-test>
        <template #header>
          Day 1
        </template>
      </day-test>

      <day-test>
        <template #header>
          Day 2
        </template>
      </day-test>

      <day-test>
        <template #header>
          Day 3
        </template>
      </day-test>

      <day-test>
        <template #header>
          Day 4
        </template>
      </day-test> -->

    <div v-for="(day, index) in days" :key="index">
         {{ 'Day' + day }}
    </div>
</div>
  </div>
</template>

<script>
  import Section from './Section.vue'
  import AddEvent from './AddEvent.vue'
  import Day from './Days.vue'
  import DayTest from './DayTest.vue'

export default {
  components: {
    'section-itinerary': Section,
    'event-itinerary': AddEvent,
    'days-itinerary': Day,
    'day-test': DayTest,
  },
  props: {
    data: {
      type: Object,
      default: () => []
    },
    days: {
      type: Number,
      default: {}
    }
  },
  data() {
    return {
     // totalDays: moment.diff(data.date_from)
    }
  }
  
  }

</script>

<style scoped>

  .primary-card {
      padding: 50px;
      height: auto;
  }

  .secondary-card {
      height: 50%;
      width: 50%;
  }

  h2 {
    color: rgb(82, 79, 79);
  }

  h5 {
    color: #666;
    font-size: 0.9em;
  }

  .day-row {
    /* content: "";
    display: inline-block;
    flex-shrink: 0;
    width: .625rem;
    height: 100%;
    transition: width 1s ease; */
    display: flex;
    width: -webkit-max-content;
    width: -moz-max-content;
    width: max-content;
  }
</style>