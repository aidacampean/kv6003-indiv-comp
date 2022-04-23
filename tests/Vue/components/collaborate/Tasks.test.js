import { shallowMount } from '@vue/test-utils'
import Tasks from '@/collaboration/Tasks.vue'
import TaskUser from '@/collaboration/TaskUser.vue'

describe('Task.vue', () => {
  it('Displays users', () => {
    const wrapper = shallowMount(Tasks, {
      propsData: {
        users: [
          {
            id: 1,
            role: "collaborator",
            trip_id: 1,
            user_id: 1,
            tasks: {
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
            tasks: {
              id: 2,
              collaborator_id: 5,
              task1: 'hotels',
              task2: 'other'
            }
          },
        ]
      },
    })

    expect(wrapper.findAllComponents(TaskUser).length).toBe(2)
  })

  it("Displays message when there are no users", () => {
    const wrapper = shallowMount(Tasks)
    expect(wrapper.find("table td").text()).toBe("There are no collaborators for this trip")
  })
})