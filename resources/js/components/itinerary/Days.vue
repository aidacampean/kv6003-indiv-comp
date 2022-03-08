<template>
<div>
    <b-modal id="modal-1" size="lg" scrollable title="Add your details to the itinerary">
      <sections-itinerary/>
    </b-modal>
    <b-row class="horizontal">
        <b-col class="bottom-margin" sm=4 v-for="(day, index) in days" :key="index">
        <b-button variant="danger" class="w-100" size="lg" v-b-modal.modal-1>{{ 'Day ' + day }}</b-button>
           <add-event :sections="trip"> </add-event>
        </b-col>
    </b-row>

        <!-- <b-card-group> -->
            <!-- <b-card>
            <b-card-text>
            </b-card-text>
            <template #footer>
                <small class="text-muted">Last updated 3 mins ago</small>
            </template>
            </b-card>

            <b-card>
            <b-card-text>
        
            </b-card-text>
            <template #footer>
                <small class="text-muted">Last updated 3 mins ago</small>
            </template>
            </b-card>

            <b-card>
            <b-card-text>

            </b-card-text>
            <template #footer>
                <small class="text-muted">Last updated 3 mins ago</small>
            </template>
            </b-card> -->
        <!-- </b-card-group> -->
</div>


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