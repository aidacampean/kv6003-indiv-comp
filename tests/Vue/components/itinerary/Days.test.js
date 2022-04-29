import { createLocalVue, mount, shallowMount } from "@vue/test-utils"
import axios from "axios"
import { BButton, BCard, BCol, BFormInput, BFormGroup, BModal, BRow, BTab, BTabs, VBModal, VBTooltip } from "bootstrap-vue"
import Days from "@/itinerary/Days.vue"
import moment from "moment"

jest.mock('axios', () => ({
  get: () =>
    Promise.resolve({
      data: {
        results: [{"success":true}],
      },
    }),
  post: () =>
    Promise.resolve({
      data: {
        results: [{"success":true,"id":114}],
      }
    })
}));


describe("Days.vue", () => {
  const localVue = createLocalVue()
  localVue.directive("b-modal",  VBModal)
  localVue.directive("b-tooltip",  VBTooltip)
  localVue.filter("formatDate", (value) => moment(String(value)).format("DD/MM/YYYY"))

  const theStubs = {
    "b-button": BButton,
    "b-card": BCard,
    "b-col": BCol,
    "b-form-input": BFormInput,
    "b-form-group": BFormGroup,
    "b-modal": BModal,
    "b-row": BRow,
    "b-tab": BTab,
    "b-tabs": BTabs,
  }

  function mountComponent (propData) {
    return mount(Days, {
      propsData: propData,
      stubs: theStubs,
      localVue,
      mocks: {
        axios,
      },
    })
  }

  test('We can add an event', () => {
    const propsData =   {
      tripId: 1,
      events: [],
      date: "2022-04-04",
      counter: 1
    }

  const wrapper = mountComponent(propsData)

    expect(wrapper.find(".add-event").text()).toBe("this is a test")


  })

  test('We can update an event', () => {

  })

  test('We can delete an event', () => {

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
})