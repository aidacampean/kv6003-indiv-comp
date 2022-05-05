import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Tasks from '@/collaboration/Tasks.vue'
import TaskUser from '@/collaboration/TaskUser.vue'
import BAlert from 'bootstrap-vue'
import "regenerator-runtime/runtime"

Vue.use(BAlert)

describe('Task.vue', () => {

  function mountComponent () {
    return shallowMount(Tasks, {
      propsData: {
        users: [
          {
            id: 1,
            role: "collaborator",
            trip_id: 1,
            user_id: 1,
            task: {
              id: 1,
              collaborator_id: 2,
              task1: 'flights',
              task2: 'other'
            }
          },
          {
            id: 2,
            role: "collaborator",
            trip_id: 1,
            user_id: 2,
            task: {
              id: 2,
              collaborator_id: 5,
              task1: 'hotels',
              task2: 'other'
            }
          },
        ]
      },
    })
  }

  it('Displays users', () => {
    const wrapper = mountComponent()
    expect(wrapper.findAllComponents(TaskUser).length).toBe(2)
  })

  it("Displays message when there are no users", () => {
    const wrapper = shallowMount(Tasks)
    expect(wrapper.find("table td").text()).toBe("There are no collaborators for this trip")
  })

  it("Displays success alert when active", async () => {
    const wrapper = mountComponent()
    await wrapper.vm.showAlert('success')
    expect(wrapper.find(".m-0").text()).toBe("The changes have been saved")
  })

  it("Dissmes an alert", async () => {
    const wrapper = mountComponent()
    await wrapper.vm.showAlert('danger')
    await wrapper.vm.resetAlert()
    expect(wrapper.vm.alertType).toBe("")
  })
})