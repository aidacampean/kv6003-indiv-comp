import { createLocalVue, mount } from "@vue/test-utils"
import Vue from 'vue'
import BootstrapVue, { VBTooltip } from "bootstrap-vue"
import Days from "@/itinerary/Days.vue"
import axios from "axios"
import moment from "moment"
import "regenerator-runtime/runtime"

Vue.use(BootstrapVue)

describe("Days.vue", () => {

  beforeAll(() => {
    jest.spyOn(axios, 'post').mockImplementation()
    jest.spyOn(axios, 'get').mockImplementation()
  })

  const localVue = createLocalVue()
  localVue.directive("b-tooltip", VBTooltip)
  localVue.filter("formatDate", (value) => moment(String(value)).format("DD/MM/YYYY"))

  function mountComponent (propData) {
    return mount(Days, {
      propsData: propData,
      localVue,
      global: {
        mocks: window.axioss
      },
      data: function() {
        return {
          modalId: "modal-1",
          form: {
            name: 'flight'
          }
        }
      }
    })
  }

  test('We can add an event', async () => {
    const propsData =   {
      tripId: 1,
      events: [],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)
    const modal = wrapper.find('#modal-1');

    expect(modal.isVisible()).toBe(false);

    await wrapper.find(".add-event").trigger("click")
    expect(modal.isVisible()).toBe(true);

    const saveButton = wrapper.find(".btn-primary")
    expect(saveButton.element.disabled).toBe(true)

    await wrapper.find("#input-1").setValue("test")

    expect(saveButton.element.disabled).toBe(false)

    const response = {
      data: {
        id: 3,
        success:true,
      }
    }

    axios.post.mockResolvedValue(response)

    await saveButton.trigger("click");
    expect(axios.post).toHaveBeenCalled()
  })

  test('Add event throws an error', async () => {
    const propsData =   {
      tripId: 1,
      events: [],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)
    const modal = wrapper.find('#modal-1');

    await wrapper.find(".add-event").trigger("click")

    const saveButton = wrapper.find(".btn-primary")

    await wrapper.find("#input-1").setValue("test")

    expect(saveButton.element.disabled).toBe(false)

    const response = {
      data: {
        errors: [
          "there was an error"
        ]
      }
    }

    axios.post.mockResolvedValue(Promise.reject({response: response}))

    await saveButton.trigger("click");
    expect(axios.post).toHaveBeenCalled()
  })

  test('We can update an event', async () => {
    const propsData =   {
      tripId: 1,
      events: [
        {
          id: 15,
          trip_id: 1,
          user_id: 1,
          name: "flight",
          date: "2022-04-05",
          description: "this is a test"
        }
      ],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)

    const modal = wrapper.find('#modal-1');
    expect(modal.isVisible()).toBe(false);
    await wrapper.find(".disabled-link").trigger("click")

    expect(modal.isVisible()).toBe(true);

    const saveButton = wrapper.find(".btn-primary")
    expect(saveButton.element.disabled).toBe(false)

    const response = {
      data: {
        success:true,
      }
    }

    axios.post.mockResolvedValue(response)

    await saveButton.trigger("click")
    expect(axios.post).toHaveBeenCalled()
  })

  test("Update event throws an error", async () => {
    const propsData =   {
      tripId: 1,
      events: [
        {
          id: 15,
          trip_id: 1,
          user_id: 1,
          name: "flight",
          date: "2022-04-05",
          description: "this is a test"
        }
      ],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)

    await wrapper.find(".disabled-link").trigger("click")

    const saveButton = wrapper.find(".btn-primary")

    const response = {
      data: {
        errors: [
          "there was an error"
        ]
      }
    }

    axios.post.mockResolvedValue(Promise.reject({response: response}))

    await saveButton.trigger("click")
    expect(axios.post).toHaveBeenCalled()
  })

  test('We can delete an event', async () => {
    const propsData =   {
      tripId: 1,
      events: [
        {
          id: 1,
          date: '2022-04-04',
          name: 'Other',
          description: 'Test description',
          trip_id: 1,
          user_id: 1
        }
      ],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)
    const deleteIcon = wrapper.find(".fa-trash-can")
    const response = {
      data: {
        success:true,
      }
    }

    axios.get.mockResolvedValue(response)

    deleteIcon.trigger("click")

    await wrapper.vm.$nextTick()
    expect(axios.get).toHaveBeenCalled()
  })

  test('Delete event throws an error', async () => {
    const propsData =   {
      tripId: 1,
      events: [
        {
          id: 1,
          date: '2022-04-04',
          name: 'Other',
          description: 'Test description',
          trip_id: 1,
          user_id: 1
        }
      ],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)
    const deleteIcon = wrapper.find(".fa-trash-can")
    const response = {
      data: {
        errors: [
          "there was an error"
        ]
      }
    }

    axios.get.mockResolvedValue(Promise.reject({response: response}))

    deleteIcon.trigger("click")

    await wrapper.vm.$nextTick()
    expect(axios.get).toHaveBeenCalled()
  })

  test('We see events for the day', () => {
    const propsData =   {
      tripId: 1,
      events: [
        {
          id: 15,
          trip_id: 1,
          user_id: 1,
          name: "flight",
          date: "2022-04-05",
          description: "this is a test"
        }
      ],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)

    expect(wrapper.find(".card-body").text()).toBe("this is a test")
  })

  test('Event type changes when clicking on navigation tab', async () => {
    const propsData =   {
      tripId: 1,
      events: [],
      date: "2022-04-04",
      counter: 1
    }

    const wrapper = mountComponent(propsData)

    await wrapper.find(".add-event").trigger("click")

    const saveButton = wrapper.find(".btn-primary")
    expect(saveButton.element.disabled).toBe(true)

    await wrapper.find("#nav-hotel-tab").trigger("click")

    expect(wrapper.vm.form.name).toBe("hotel")
  })
})