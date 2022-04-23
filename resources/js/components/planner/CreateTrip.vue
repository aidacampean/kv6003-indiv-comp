<template>
  <b-card class="sm position-relative">
    <b-form name="create-trip" class="root justify-content-sm-center" v-on:submit.prevent>
      <b-row class="fixed">
        <b-col class="mx-md-2 pb-md-3">
          <label for="city">City</label>
            <b-form-select
              id="city"
              v-model="form.city_id"
              value-field="id"
              text-field="name"
              class="form-control"
              :state="changeState('city_id')"
              style="max-height: 200px;"
            >
              <option :value="0">Please select a destination</option>
              <option v-for="option in options" :key="option.id" :value="option.id">
                {{ option.name }}
              </option>
              <p>{{ }}</p>
            </b-form-select>

          <b-form-invalid-feedback id="city-feedback">
            Please select a city
          </b-form-invalid-feedback>
        </b-col>

        <b-col class="mx-md-2 pb-md-3">
            <label for="tripName">Trip Name</label>
            <b-form-input
              id="trip-name"
              type="text"
              placeholder="Enter trip name"
              v-model="form.name"
              :state="changeState('name')"
            ></b-form-input>
            <b-form-invalid-feedback id="trip-name-feedback">
              Please enter a trip name
            </b-form-invalid-feedback>
        </b-col>

        <b-col  class="mx-md-2 pb-md-3">
          <label for="date-from">Date From</label>
          <b-form-datepicker
            id="date-from"
            v-model="form.date_from"
            :min="min"
            hide-header
            :state="changeState('date_from')"
          />
          <b-form-invalid-feedback id="date-from-feedback">
            Please enter a departure date
          </b-form-invalid-feedback>
        </b-col>

        <b-col sm=3 class="mx-md-2 pb-md-3">
          <label for="date-to">Date To</label>
          <b-form-datepicker
            id="date-to"
            v-model="form.date_to"
            :disabled="form.date_from == ''"
            :min="form.date_from"
            :max="maxDays()"
            :state="changeState('date_to')"
            hide-header
          />
          <b-form-invalid-feedback id="date-to-feedback">
            Please select an arrival date
          </b-form-invalid-feedback>
        </b-col>
      </b-row>

      <b-row class="mt-md-2 mx-md-4">
        <b-col sm=9>
          <b-button
            name="submit"
            class="clearfix"
            type="submit"
            variant="dark"
            @click="submitForm"
          >
            Plan your trip
          </b-button>
        </b-col>
      </b-row>
      <input type="hidden" name="_token" :value="csrf" />
    </b-form>
  </b-card>
</template>

<script>
  import moment from 'moment';

  export default {
    props: {
      options: {
        type: Array,
        default: [],
      }
    },
    data() {
      return {
        form: {
          city_id: 0,
          description: '',
          name: '',
          date_from: '',
          date_to: '',
        },
        nameState: null,
        test: '',
        min: moment().format('YYYY-MM-DD'),
      }
    },
    methods: {
      changeState(field) {
        if (this.errors) {
          this.errors.hasOwnProperty(field) ? false : null
        }

        return null;
      },
      maxDays() {
        if (this.form.date_from  != '') {
          return moment(this.form.date_from, "YYYY-MM-DD").add(14, 'days').format('YYYY-MM-DD');
        }
        return this.min;
      },
      submitForm(){
        axios.post('/trip/store/',
          this.form,
        ).then(({data})=> {
          window.location.href = "/trip/" + data.id + "/itinerary"
        }).catch(({response}) => {
          this.errors = response.data.errors
        })
      },
    }
  }
</script>

<style scoped>
  .fixed {
      padding-top: 40px;
      padding-bottom: 40px;
      height: 200px;
      width:75%;
      align-items: center;
  }
</style>