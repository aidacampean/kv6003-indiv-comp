<template>
  <b-col class="bottom-margin" lg=3>
        <b-modal :id="modalId" size="lg" hide-footer scrollable title="Add your details to the itinerary">
          <nav v-show="form.id == ''" >
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
                class="nav-link" 
                id="nav-other-tab"
                data-toggle="tab" 
                href="#nav-other" 
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
          <div v-show="form.id"><h5>{{ form.name.charAt(0).toUpperCase() + form.name.slice(1) }}</h5></div>
          <div class="tab-pane fade show active" id="nav-flights" role="tabpanel" aria-labelledby="nav-flights-tab">
             <b-form-group
              id="input-group-1"
              label-for="input-1"
              class="mx-3 pt-3"
            >
            <label for="input-1" class="mt-2">Add flight details</label>
              <b-form-input
                id="input-1"
                type="text"
                placeholder="Booking reference number"
                required
                v-model="form.description"
              ></b-form-input>
              <label for="textarea-small" class="mt-4">Notes</label>
              <b-form-textarea
                id="textarea"
                placeholder="Enter something..."
                rows="3"
                max-rows="6"
                v-model="form.notes"
              ></b-form-textarea>
            </b-form-group>
          </div>

          <div class="tab-pane fade" id="nav-hotels" role="tabpanel" aria-labelledby="nav-hotels-tab">
            <b-form-group
              id="input-group-2"
              label-for="input-2"
              class="mx-3 pt-3"
            >
              <label for="input" class="mt-2">Search</label>
              <b-form-input
                id="input-2"
                type="text"
                required
                v-model="form.description"
              ></b-form-input>
              <label for="textarea-small" class="mt-4">Notes</label>
              <b-form-textarea
                id="textarea"
                placeholder="Enter something..."
                rows="3"
                max-rows="6"
                v-model="form.notes"
              ></b-form-textarea>
             
            </b-form-group>
          </div>

          <div class="tab-pane fade" id="nav-excursions" role="tabpanel" aria-labelledby="nav-excursions-tab">
            <b-form-group
              id="input-group-3"
              label-for="input-3"
              class="mx-3 pt-3"
            >
              <label for="input" class="mt-2">Add excursion details</label>
              <b-form-input
                id="input-3"
                type="text"
                placeholder="Add excursion"
                required
                v-model="form.description"
              ></b-form-input>
              <label for="textarea-small" class="mt-4">Notes</label>
              <b-form-textarea
                id="textarea"
                placeholder="Enter something..."
                rows="3"
                max-rows="6"
                v-model="form.notes"
              ></b-form-textarea>
            </b-form-group>
          </div>

          <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">
            <b-form-group
              id="input-group-4"
              label-for="input-4"
              class="mx-3 pt-3"
            >
              <label for="input" class="mt-2">Add other details</label>
              <b-form-input
                id="input-4"
                type="text"
                placeholder="Add other activities here"
                required
                v-model="form.description"
              ></b-form-input>
              <label for="textarea-small" class="mt-4">Notes</label>
              <b-form-textarea
                id="textarea"
                placeholder="Add any other notes here"
                rows="3"
                max-rows="6"
                v-model="form.notes"
              ></b-form-textarea>
            </b-form-group>
          </div>

            <b-button
              class="ml-3 mt-3"
              variant="primary"
              @click="form.id == '' ? saveEvent() : updateEvent(form.id);"
              :disabled="!form.description"
            >
              Save
            </b-button>
            <b-button class="ml-3 mt-3" variant="danger" @click="$bvModal.hide(modalId)">Cancel</b-button>
        </div>
      </b-modal>

    <b-modal :id="date" size="lg" scrollable hide-header>
      <h2>{{ 'DAY SUMMARY' }}</h2>
      <div class="mt-2"><h5>{{ 'DATE: ' }} {{ date | formatDate }}</h5></div>
      <day-summary 
      :data="events"
      />
    </b-modal>
 
    <b-button
      variant="green"
      class=" text-white w-100"
      size="lg"
      @click="$bvModal.show(date);"
    >
      {{ 'DAY ' + counter + ' - '  }} {{ date | formatDate }}
    </b-button>

    <button class="add-event" @click="addModal(modalId)">
      + ADD
    </button>
    <b-card class="m-2" v-for="(event, index) in eventsData" :key="event.id" >
      <a href="#" class="disabled-link" @click="updateModal(index);">{{ event.description }}</a>
      <i class="float-right fa-regular fa-square-minus" @click="deleteEvent(event.id, index);"></i>
    </b-card>
  </b-col>
</template>

<script>
  import Toast from './Toast.vue';
  import DaySummary from './DaySummary.vue';

  export default { 
    components: {
      'toast': Toast,
      'day-summary': DaySummary
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
      }
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
          index: '',
          notes: ''
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
          index: '',
          notes: ''
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
          index: index,
          notes: data.notes
        };
        this.$bvModal.show(this.modalId);
      },
      saveEvent() {
        axios.post('/trip/add-event', {
          'id' : this.tripId,
          'name' : this.form.name,
          'description': this.form.description,
          'date': this.date,
          'notes': this.form.notes
        }).then(({data})=> {
            //push the data to the events array to show without reloading
            this.eventsData.push({
              'id': data.id,
              'trip_id': this.tripId,
              'name': this.form.name,
              'description': this.form.description,
              'date': this.date,
              'notes': this.form.notes
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
          'description': this.form.description,
          'notes': this.form.notes
        }).then((data)=> {
            //push the data to the events array to show without reloading
            if (data.status == 200) {
              this.$set(this.eventsData[this.form.index], 'name', this.form.name);
              this.$set(this.eventsData[this.form.index], 'description', this.form.description);
              this.$set(this.eventsData[this.form.index], 'notes', this.form.notes);
              this.$bvModal.hide(this.modalId);
            }
        }).catch(({response}) => {
          this.errors = response.data.errors
        })
      },
      setEvent(event) {
        return this.form.name = event;
      },
      searchHotel() {
        axios({
          method: 'get', //you can set what request you want to be
          url: 'https://booking-com.p.rapidapi.com/v1/hotels/search',
          params: {
            dest_id: '-1156174',
            dest_type: 'city',
            locale: 'en-gb',
            checkin_date: '',
            checkout_date: '',
          },
          headers: {
            'X-RapidAPI-Host': 'booking-com.p.rapidapi.com',
            'X-RapidAPI-Key': '64808efcb9mshdbbd115b58b2858p1ee947jsn79d44e85a5e1'
          }
        })
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