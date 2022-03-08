<template>
<div>
  <b-container>
      <i :class="hide ? showIcon : hideIcon" @click="changeState();"></i>
      {{ ' RESERVATIONS'  }}
      <b-dropdown class="icon" size="lg"  variant="link" toggle-class="text-decoration-none" no-caret>
        <template #button-content>
        <i class="fas fa-ellipsis-v"></i>
        </template>
          <b-dropdown-item href="#">Edit</b-dropdown-item>
          <b-dropdown-item href="#">Delete</b-dropdown-item>
      </b-dropdown>
       <div class="content" v-show="!hide">
          this is a test
        </div>
    <!-- <b-button class="ml-2" variant="secondary" size="sm">Edit</b-button>
    <b-button variant="danger" size="sm">Delete</b-button> -->
  </b-container>
   
</div>
</template>

<script>
  export default {
    props: {
      sections: {
        type: Array,
        default: [{}]
      }
    },
    data() {
        return {
          // form: {
          //   name: '',
          //   description: ''
          // },
          hide: true,
          showIcon: 'fa-solid fa-angle-right',
          hideIcon: 'fa-solid fa-angle-down'
        }
    },
    methods: {
      changeState() {
        return this.hide = this.hide ? false : true;
      },
      submitForm(){
        // axios.post('/trip/store/', {
        //   'name': this.form.name,
        //   'description': this.form.description
        // }).then(({data})=> {
        //   window.location.href = "/trip/" + data.id + "/itinerary"
        // }).catch(({response}) => {
        //   this.errors = response.data.errors
        // })
      }
    }
  }
</script>

<style scoped>
/* .add-font {
  font-weight: 70px;
} */

.icon {
  position: absolute;
  right: 0px;
}
 </style>