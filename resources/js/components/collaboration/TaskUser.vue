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
        variant="dark"
        @click="saveTasks"
        class="clearfix"
      >
        Save
      </b-button>
      <a
          class="text-white btn btn-secondary"
          href="#"
          @click="deleteUser"
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
          errors: [],
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
        let tasks = this.$props.data.tasks;
        if (tasks) {
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