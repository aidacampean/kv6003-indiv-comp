<template>
<div id="app" class="min-h-screen w-screen bg-gray-200 flex items-center justify-center">
    <!-- <draggable
      :list="users"
      :animation="200"
      ghost-class="moving-card"
      group="users"
      filter=".action-button"
      class="w-full max-w-md"
      tag="ul"
    >
      <user-card
        v-for="user in users"
        :key="user.id"
        :user="user"
        @on-edit="onEdit"
        @on-delete="onDelete"
      ></user-card>
    </draggable> -->
    {{ trip}} 
  </div>
</template>

<script>
import Users from "./Users";
import Draggable from 'vuedraggable';

export default {
    name: 'drag-and-drop',
    components: {
        Draggable,
        Users
    },
    props: {
      trip: {
        type: Array,
        default: []
      }
    },
    data() {
      return {
        users: {
            collaborator_username: ''
        },
      }
    },
    methods: {
      onEdit(user) {
        alert(`Editing ${user.name}`);
      },
      onDelete(user) {
        alert(`Deleting ${user.name}`);
      },
      
    }
}
</script>
