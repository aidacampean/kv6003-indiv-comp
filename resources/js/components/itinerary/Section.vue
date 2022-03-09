<template>
<div>
  <b-container>
      <i :class="hide ? showIcon : hideIcon" @click="changeState();"></i>
        {{ name }}
      <b-dropdown class="icon" variant="link" toggle-class="text-decoration-none" no-caret>
        <template #button-content>
        <i class="fas fa-ellipsis-v"></i>
        </template>
          <b-dropdown-item href="">Edit</b-dropdown-item>
          <b-dropdown-item @click="deleteAction()">Delete</b-dropdown-item>
      </b-dropdown>
       <div class="content" v-show="!hide">
  
       </div>
    <!-- <b-button class="ml-2" variant="secondary" size="sm">Edit</b-button>
    <b-button variant="danger" size="sm">Delete</b-button> -->
  </b-container>
   
</div>
</template>

<script>
  export default {
    props: {
      name: {
        type: String,
        default: null
      }
    },
    data() {
        return {
          hide: true,
          showIcon: 'fa-solid fa-angle-right',
          hideIcon: 'fa-solid fa-angle-down'
        }
    },
    methods: {
      changeState() {
        return this.hide = this.hide ? false : true;
      },
      deleteAction(){
        axios.post('/trip/{id}/itinerary/section/delete', {
          'name': this.name
        }).then(()=> {
        }).catch(({response}) => {
          this.errors = response.data.errors
        })
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