<template>
  <li
    class="p-4 mb-3 flex justify-between items-center bg-white shadow rounded-lg cursor-move border border-white"
  >
    <div class="flex items-center">
      <img class="w-10 h-10 rounded-full" :alt="user.name">
      <p class="ml-2 text-gray-700 font-semibold font-sans tracking-wide">{{user.name}}</p>
    </div>
    <div class="flex">
      <button
        aria-label="Edit user"
        class="action-button p-1 focus:outline-none focus:shadow-outline text-teal-500 hover:text-teal-600"
        @click="$emit('on-edit', user)"
      >
      </button>
      <button
        aria-label="Delete user"
        class="action-button p-1 focus:outline-none focus:shadow-outline text-red-500 hover:text-red-600"
        @click="$emit('on-delete', user)"
      >
      </button>
    </div>
  </li>
</template>
<script>
import Draggable from 'vuedraggable';

export default {
  components: {
    Draggable
  },
  props: {
    user: {
      type: Object,
      default: () => ({})
    },
    tripId: {
       type: Number,
      default: 0
    }
  },
  data() {
    return {
      form: {
          collaborator_id: '',
          trip_id: '',
          username: ''
        },
    }
  },
  methods: {
    getUser(tripId) {
      axios.get('/trip/' + tripId + 'tasks')
      .then(({response})=> {
        console.log(response)
      }).catch(({response}) => {
        this.errors = response.data.errors;
      })
    },
  }
};
</script>
