<template>
<div>
        <b-row class="horizontal">
            <b-col class="bottom-margin" sm=4 v-for="(day, index) in days" :key="index">
            <b-button variant="danger" class="w-100" size="lg" v-b-modal.modal-1>{{ 'Day ' + day }}</b-button>
                <day-test/>
            </b-col>
        </b-row>

        <b-card-group>
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
        </b-card-group>
  <b-modal id="modal-1" size="xl" scrollable title="Add your details to the itinerary">
    <p class="my-4" v-for="i in 20" :key="i"> Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis
      in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
  </b-modal>

</div>

</template>

<script>
import DayTest from './DayTest.vue'

export default { 
    components: {
        'day-test': DayTest
    },
    name: 'days-itinerary',
    props: {
        options: {
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

.horizontal {
    overflow-x: scroll;
    overflow: hidden;
}

.bottom-margin {
    margin-bottom: 50px;
}

</style>