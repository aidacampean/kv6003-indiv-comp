<template>
  <div class="table-responsive">
    <table class="table">
      <thead>
          <tr>
              <th class="col-lg-2 col-sm-2">Username</th>
              <th class="col-lg-3 col-sm-3">Email</th>
              <th class="col-lg-5 col-sm-5 text-center">Task Assignment</th>
              <th class="col-lg-2 col-sm-2"></th>
          </tr>
      </thead>
      <tbody v-if="users.length > 0">
        <task-user v-for="user in users" :data="user" :key="user.id" />
      </tbody>
      <tbody v-else>
        <tr>
          <td colspan="3">
            There are no collaborators for this trip
          </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
    import TaskUser from './TaskUser.vue'
    export default {
      components: {
        'task-user': TaskUser
      },
      props: {
        users: {
          type: Array,
          default() {
            return []
          }
        }
      },
      data() {
        return {
          tasks: [
            {
              name: 'flight',
            },
            {
              name: 'hotel'
            },
            {
              name: 'excursion'
            },
            {
              name: 'other'
            }
          ],
          flightLimit: 2,
          hotelLimit: 2,
          excursionLimit: 2,
          otherLimit: 2,
          errors: []
        }
      }
    }
</script>