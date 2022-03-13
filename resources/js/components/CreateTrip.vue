<template>
  <b-card>
    <b-form name="create-trip" class="root justify-content-md-center" v-on:submit.prevent>
      <b-form-group
        id="input-group-1"
        label-for="input-1"
        class="mx-3 pt-4"
      >
      
        <b-form-select
          size="lg"
          id="input-1"
          v-model="form.city_id"
          value-field="id"
          text-field="name"
          label="city"
          class="form-control"
          required
        >
         <option :value="0">Please select a destination</option>
          <option :key="option.id" v-for="option in options" :value="option.id">
            {{ option.name }}
          </option>
        </b-form-select>

          <!-- <b-dropdown 
          id="input-1" 
          text="Destination" 
          variant="light" 
          class="m-2"
          v-model="form.destination"
          :options="destination"
          required
      >
          <b-dropdown-item>Cluj</b-dropdown-item>
          <b-dropdown-item>Bucharest</b-dropdown-item>
          <b-dropdown-item href="#">Something else here</b-dropdown-item>
      </b-dropdown> -->
       </b-form-group> 

      <b-form-group
        id="input-group-2"
        label-for="input-2"
        class="mx-3  pt-4"
      >
        <b-form-input
        size="lg"
          id="input-2"
          type="text"
          label="Trip Name"
          placeholder="Enter trip name"
          required
          v-model="form.name"
        ></b-form-input>

      </b-form-group>

      <b-form-group
        id="input-group-3"
        label="Departure"
        label-for="input-3"
        class="mx-3"
      >
        <b-form-datepicker

          id="input-3"
          v-model="form.date_from"
          :class="[{'form-error': errors.includes('date_from')}]"
        />
      
      </b-form-group>

      <b-form-group
        id="input-group-4"
        label="Arrival"
        label-for="input-4"
        class="mx-3"
      >
        <b-form-datepicker
          id="input-4"
          v-model="form.date_to"
          :class="[{'form-error': errors.includes('date_to')}]"
          />
      
      </b-form-group>

      <b-button
        type="submit"
        variant="dark"
        class="mx-3 mt-4"
        @click="submitForm"
      >
        Plan your trip
      </b-button>
      <input type="hidden" name="_token" :value="csrf" />
    </b-form>
  </b-card>
</template>

<script>
    export default {
      props: {
        options: {
          type: Array,
          default: [{}],
        }
      },
      data() {
        return {
          form: {
            // default value is 'Please select ....'
            city_id: '0',
            name: '',
            date_from: '',
            date_to: '',
          },
          errors: [],
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      },
      methods: {
        submitForm(){
          axios.post('/trip/store/', {
            'name': this.form.name,
            'city_id': this.form.city_id,
            'date_from': this.form.date_from,
            'date_to': this.form.date_to,
          }).then(({data})=> {
            window.location.href = "/trip/" + data.id + "/itinerary"
          }).catch(({response}) => {
            this.errors = response.data.errors
          })
        }
      }
    }
</script>