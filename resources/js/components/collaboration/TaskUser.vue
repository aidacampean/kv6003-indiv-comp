<template>
  <tr>
    <td>
      {{data.user.username}}
    </td>
    <td>
      {{data.user.email}}
    </td>
    <td class="text-center">
      <b-form-checkbox-group v-model="form.selected" switches>
        <b-form-checkbox
          v-for="task in this.$parent.tasks"
          @change.native="checkLimits(task.name, $event)"
          :key="task.name"
          :value="task.name"
          :disabled="isDisabled(task.name)"
        >
          {{ task.name }}
        </b-form-checkbox>
      </b-form-checkbox-group>
    </td>
    <td>
      <b-button
        type="submit"
        variant="primary"
        @click="saveTasks"
        class="clearfix mb-md-2 mb-xl-0"
        v-b-tooltip.hover title="This button will save or update the tasks"
      >
        Save
      </b-button>
      <a v-if="data.role !== 'admin'"
          class="text-white btn btn-dark"
          href="#"
          @click="deleteUser"
          v-b-tooltip.hover title="This button will delete the user"
      >
      
        Delete
      </a>
    </td>
  </tr>
</template>

<script>
    export default {
      props: {
        data: {
          type: Object,
          default: () => [],
        },
      },
      data() {
        return {
          form: {
            selected: []
          },
          errors: []
        }
      },
      methods: {
        checkLimits(task, event) {
          let name = task+'Limit';
          //if there is a click event, deduct one from the task limit
          if (event.target.checked) {
            this.$parent[name]--;
          } else {    //the task is unchecked so increment
            this.$parent[name]++;
          }
        },
        isDisabled(task) {
          return (this.form.selected.length == 2 || this.$parent[task+'Limit'] == 0) && this.form.selected.indexOf(task) === -1;
        },
        saveTasks() {
          axios.post('/trip/'+this.data.trip_id+'/add-task/'+this.data.id, {
            'task1': this.form.selected[0] ? this.form.selected[0] : null,
            'task2': this.form.selected[1] ? this.form.selected[1] : null,
          }).then(()=> {
          }).catch(({response}) => {
            this.errors = response.data.errors
          })
        },
        deleteUser() {
          axios.get('/trip/'+this.data.trip_id+'/destroy-collaborator/'+this.data.id)
          .then(()=> {
            this.$delete(this.data.id)
          }).catch(({response}) => {
            this.errors = response.data.errors
          })
        }
      },
      // needed to work out the limits
      created: function () {
       if (Object.keys(this.$props.data.task).length > 0) {
          let tasks = this.$props.data.task[0];

          if (tasks.task1) {
            this.$parent[tasks.task1+'Limit']--;
            this.form.selected.push(tasks.task1);
          }
          if (tasks.task2) {
            this.$parent[tasks.task2+'Limit']--;
            this.form.selected.push(tasks.task2);
          }
        }
      }
    }
</script>