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
          onclick="return confirm('Are you sure?')"
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
        }
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
          let name = task+'Limit';

          //each task will be checked to determine if it's disabled
          //user has max tasks of two so we check the length of the array or
          //we check the defined task limit in the Task component to determine if we can assign a user to that task
          //if either of the first two statements are true, all checkboxes are disabled and that includes the ones selected.
          //to get around this we need to check if the task is in the array, and if not it's disabled
          //-1 indicates we can't find the value in the array.
          //For anything that's in the array, this will return false, thus keeping that task enabled so that it can 'switched off'
          //or the task allocation is maxed and the selected array has the item (so we can at least disable a checked box)
          
          return (this.form.selected.length === 2 || this.$parent[name] == 0) && this.form.selected.indexOf(task) === -1;
        },
        saveTasks() {
          axios.post('/trip/'+this.data.trip_id+'/add-task/'+this.data.id, {
            'task1': this.form.selected[0] ? this.form.selected[0] : null,
            'task2': this.form.selected[1] ? this.form.selected[1] : null,
          }).then(({data})=> {
          }).catch(({response}) => {
            this.errors = response.data.errors
          })
        },
        deleteUser() {
        }
      },
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