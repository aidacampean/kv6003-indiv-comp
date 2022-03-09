<template>
  <b-col class="bottom-margin" sm=4>
    <b-button variant="danger" class="w-100" size="lg" v-b-modal.modal-1>{{ 'Day ' + id }}</b-button>
      <add-event :sections="trip"> </add-event>
  </b-col>

</template>

<script>
import Section from './Section.vue'
import AddEvent from './AddEvent.vue'

export default { 
    components: {
        'sections-itinerary': Section,
        'add-event': AddEvent
    },
    props: {
        trip: {
          type: Array,
          default: () => []
        },
        id: {
          type: Number,
          default: {}
        }
    },
    data() {
        return {
            count: 0
        }
    },
    methods: {
        incrementDays() {
            this.count += 1;
        }
    }


}

</script>

<style scope>

.modal-dialog-scrollable .modal-content {
    min-height: calc(100vh - 4rem);
}

.horizontal {
    overflow-x: scroll;
    overflow: hidden;
}

.bottom-margin {
    margin-bottom: 50px;
}

</style>