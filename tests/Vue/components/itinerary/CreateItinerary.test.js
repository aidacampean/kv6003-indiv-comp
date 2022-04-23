import { createLocalVue, mount, shallowMount } from "@vue/test-utils"
import { BButton, BCol, BFormInput, BFormGroup, BModal, VBModal, BRow, BTab, BTabs } from "bootstrap-vue"
import CreateItinerary from "@/itinerary/CreateItinerary.vue"
import Days from "@/itinerary/Days.vue"
import moment from "moment"

describe("CreateItinerary.vue", () => {

  const tripData = {
    id: 1,
    user_id: 5,
    name: "Test Trip",
    city_id: 2,
    date_from: "2022-09-01",
    date_to: "2022-09-08",
    days: {
      "2022-09-01" : [],
      "2022-09-02" : [],
      "2022-09-03" : [],
      "2022-09-04" : [],
      "2022-09-05" : [],
      "2022-09-06" : [],
      "2022-09-07" : [],
      "2022-09-08" : [],
    }
  }

  it("Displays trip information on load", () => {
    const localVue = createLocalVue();
    localVue.directive('b-modal',  VBModal)
    localVue.filter("formatDate", (value) => moment(String(value)).format("DD/MM/YYYY"))

    const wrapper = mount(CreateItinerary, {
      propsData: {
        trip: tripData
      },
      stubs: {
        "b-button": BButton,
        "b-col": BCol,
        "b-form-input": BFormInput,
        "b-form-group": BFormGroup,
        "b-modal": BModal,
        "b-row": BRow,
        "b-tab": BTab,
        "b-tabs": BTabs
      },
      localVue
    })

    expect(wrapper.find("h2").text()).toBe("Trip to Test Trip")
    expect(wrapper.find("h5").text()).toBe("01/09/2022 to 08/09/2022")
    expect(wrapper.findAllComponents(Days).length).toBe(8)
  })

  it("Displays no information if prop is empty", () => {

    const localVue = createLocalVue();
    localVue.filter("formatDate", (value) => value)

    const wrapper = shallowMount(CreateItinerary, {
      stubs: {
        "b-row": BRow,
      },
      localVue
    })

    expect(wrapper.findAllComponents(Days).length).toBe(0)
  })
})