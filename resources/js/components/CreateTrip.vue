<template>
  <b-card>
    <b-form name="create-trip" class="root justify-content-md-center" v-on:submit.prevent>   
      <b-col>
       <FormError :errors="formErrors.city_id">
        <b-form-select
          size="lg"
          id="input-1"
          v-model="form.city_id"
          value-field="id"
          text-field="name"
          label="city"
          required
        >
         <option :value="0">Please select a destination</option>
          <option :key="option.id" v-for="option in options" :value="option.id">
            {{ option.name }}
          </option>
        </b-form-select>
       </FormError>
      </b-col>

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
          <!-- <div v-show="errors.includes('destination')" class="mt-2 text-danger">
             Please select the destination
          </div> -->

       <!-- </b-form-group> 

      <b-form-group
        id="input-group-2"
        label-for="input-2"
        class="mx-3 mt-4"
      > -->
    <b-col>
        <b-form-input
          size="lg"
          id="input-2"
          type="text"
          label="Trip Name"
          placeholder="Enter trip name"
          v-model="form.name"
        ></b-form-input>
        <div v-show="form.name == '' && errors.name" class="mt-2 text-danger">
          Please enter a name
        </div>
    </b-col>
      <!-- </b-form-group>

      <b-form-group
        id="input-group-3"
        label="Departure"
        label-for="input-3"
        class="mx-3 "
      > -->
       <b-col>
        <b-form-datepicker
          id="input-3"
          v-model="form.date_from"
          required
          :min="min"
          :max="max"
          size="lg"
        />
       </b-col>

         <!-- <div class="errors" v-if="showError">{{ error }}</div>  -->
        <!-- <div v-show="errors.includes('departure date')" class="mt-2 text-danger">
          Please enter a departure date
        </div> -->

      <!-- </b-form-group>
      <b-form-group
        id="input-group-4"
        label="Arrival"
        label-for="input-4"
        class="mx-3"
      > -->
       <b-col>
        <b-form-datepicker
          id="input-4"
          v-model="form.date_to"
          required
          :min="min"
          :max="max"
          size="lg"
        />
       </b-col>
       <!-- <div v-show="errors.includes('departure date')" class="mt-2 text-danger">
          Please enter an arrival date
        </div> -->

    <b-col>
      <b-button
      size="lg"
        type="submit"
        variant="dark"
        @click="submitForm"
      >
        Plan your trip
      </b-button>
    </b-col>

      <input type="hidden" name="_token" :value="csrf" />
    </b-form>
  </b-card>
</template>

<script>
  import FormError from './FormError';
  import ErrorMixin from './mixins/ErrorMixin';

  export default {
 components: {
      'FormError': FormError
    },
    mixins:[ErrorMixin],
    props: {
      options: {
        type: Array,
        default: [{}],
      }
    },
    data() {
      const now = new Date()
      const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
      // 15th two months prior
      const minDate = new Date(today)
      minDate.setMonth(minDate.getMonth() - 2)
      minDate.setDate(15)
      // 15th in two months
      const maxDate = new Date(today)
      maxDate.setMonth(maxDate.getMonth() + 2)
      maxDate.setDate(15)
      return {
        form: {
          // default value is 'Please select ....'
          city_id: '0',
          name: '',
          date_from: '',
          date_to: '',
        },
        errors: {

        },
        min: minDate,
        max: maxDate,
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        showError: false
      }
    },
    methods: {
      
      submitForm(){

        // this.errors = [];

        //   if (this.form.city_id == 0) {
        //     this.errors.push('destination');
        //   }

        //   if (!this.form.name) {
        //     this.errors.push('name');
        //   }

        //   if (!this.form.date_from) {
        //     this.errors.push('departure date');
        //   }

        //   if (!this.form.date_to) {
        //     this.errors.push('arrival date');
          
        //   }

        //   console.log(this.errors)


        // if (this.errors.length == 0) {

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
        // }
      }
    }
  }
</script>

<style scoped>
.card {
    padding-top: 40px;
    padding-bottom: 40px;
    height: 100%;
    width:100%;
    align-items: center;

}
</style>