<template>
  <b-col class="bottom-margin" lg=3>
        <b-modal :id="modalId" size="xl" hide-footer scrollable title="Add your details to the itinerary">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a
                class="nav-link active"
                id="nav-flights-tab"
                data-toggle="tab"
                href="#nav-flights"
                role="tab"
                aria-controls="nav-flights"
                aria-selected="true"
                @click.prevent="setEvent('flight')"
                >
                Flights
              </a>

              <a 
                class="nav-link" 
                id="nav-hotel-tab" 
                data-toggle="tab" 
                href="#nav-hotels" 
                role="tab" 
                aria-controls="nav-hotels" 
                aria-selected="false" 
                @click="setEvent('hotel')"
                >
                Hotel
              </a>

              <a 
                class="nav-link"
                id="nav-excursions-tab" 
                data-toggle="tab"
                href="#nav-excursions" 
                role="tab" 
                aria-controls="nav-excursions" 
                aria-selected="false" 
                @click="setEvent('excursion')"
                >
                Excursions
              </a>
              
              <a 
                class="nav-link disabled" 
                id="nav-contact-tab"
                data-toggle="tab" 
                href="#nav-contact" 
                role="tab"
                aria-controls="nav-other" 
                aria-selected="false"
                @click="setEvent('other')"
                >
                Other
              </a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-flights" role="tabpanel" aria-labelledby="nav-flights-tab">
             <b-form-group
              id="input-group-2"
              label-for="input-2"
              class="mx-3 pt-3"
            >
              <b-form-input
                id="input-2"
                type="text"
                placeholder="Booking reference number"
                required
                v-model="form.description"
              ></b-form-input>
            </b-form-group>
            <b-button class="ml-3" variant="primary" @click="form.id == '' ? saveEvent() : updateEvent(form.id);">Save</b-button>
            <b-button variant="danger" @click="$bvModal.hide(modalId)">Cancel</b-button>
          </div>

          <div class="tab-pane fade" id="nav-hotels" role="tabpanel" aria-labelledby="nav-hotels-tab">...</div>
          <div class="tab-pane fade" id="nav-excursions" role="tabpanel" aria-labelledby="nav-excursions-tab">...</div>
        </div>

      </b-modal>

    <b-button
      variant="green"
      class=" text-white w-100"
      size="lg"
    >
      {{ 'Day ' + counter + ' - '  }} {{ date | formatDate }}
    </b-button>

    <button class="add-event" @click="addModal(modalId)">
      + Add
    </button>
    <b-card class="m-2" v-for="(event, index) in eventsData" :key="event.id" >
      <a href="#" class="disabled-link" @click="updateModal(index);">{{ event.description }}</a>
      <i class="float-right fa-regular fa-square-minus" @click="deleteEvent(event.id, index);"></i>
    </b-card>
  </b-col>
</template>

<script>
  import Toast from './Toast.vue';
  export default { 
    components: {
      'toast': Toast
    },
    props: {
      tripId: {
        type: Number,
        default: 0
      },
      events: {
        type: Array,
        default: () => []
      },
      date: {
        type: String,
        default: 0
      },
      counter: {
        type: Number,
        default: 0
      },
    },
    data() {
      return {
        modalId: 'modal-'+this.counter,
        eventsData: this.events,
        form: {
          id: '',
          name: 'flight',
          description: '',
          date: this.date,
          index: ''
        },
      }
    },
    methods: {
      addModal() {
        this.form = {
          id: '',
          name: 'flight',
          description: '',
          date: this.date,
          index: ''
        };
        this.$bvModal.show(this.modalId);
      },
      updateModal(index) {
        let data = this.events[index];

        this.form = {
          id: data.id,
          name: data.name,
          description: data.description,
          date: this.date,
          index: index
        };
        this.$bvModal.show(this.modalId);
      },
      saveEvent() {
        axios.post('/trip/add-event', {
          'id' : this.tripId,
          'name' : this.form.name,
          'description': this.form.description,
          'date': this.date
        }).then(({data})=> {
            //push the data to the events array to show without reloading
            this.eventsData.push({
              'id': data.id,
              'trip_id': this.tripId,
              'name': this.form.name,
              'description': this.form.description,
              'date': this.date
            });
            this.$bvModal.hide(this.modalId);
        }).catch(({response}) => {
          this.errors = response.data.errors
        })
      },
      deleteEvent(eventId, index) {
        axios.get('/trip/destroy-event/' + eventId)
        .then(()=> {
            //delete from array to show deletion without reloading
            this.$delete(this.eventsData, index);
        }).catch(({response}) => {
          this.errors = response.data.errors;
        })
      },
      updateEvent(eventId) {
        axios.post('/trip/update-event/' + eventId, {
          'id': this.tripId,
          'name': this.form.name,
          'description': this.form.description
        }).then((data)=> {
            //push the data to the events array to show without reloading
            if (data.status == 200) {
              this.$set(this.eventsData[this.form.index], 'name', this.form.name);
              this.$set(this.eventsData[this.form.index], 'description', this.form.description);
              this.$bvModal.hide(this.modalId);
            }
        }).catch(({response}) => {
          this.errors = response.data.errors
        })
      },
      setEvent(event) {
        return this.form.name = event;
      }
    }
  }

</script>

<style lang="scss" scoped>

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

  .add-event {
    border: 0;
    margin-top:10px;
    padding: 5px;
    text-align: center;
    background-color: rgb(240, 238, 238);
    color: #999;
    width: 100%;
  }


  .card-body {
    &a, :active, :link, :visited {
        color: black;
        text-decoration: none;
    }
    :hover {
      color: grey;
    }
  }

.btn-green {
  background-color: #00686c;
}
</style>