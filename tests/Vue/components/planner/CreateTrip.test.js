import { shallowMount } from "@vue/test-utils"
import axios from "axios"
import { BButton, BCard, BForm, BFormDatepicker, BFormGroup, BFormInput, BFormInvalidFeedback, BFormSelect } from "bootstrap-vue"
import CreateTrip from "@/planner/CreateTrip.vue"
import "regenerator-runtime/runtime"

describe("CreateTrip.vue", () => {

  //save the original location so we can reassign afterwards to not affect other tests
  const realLocation = global.location

  //redirect used using window so we need to mock the functionality with location
  beforeAll(() => {
    delete global.location
    global.location = { assign: jest.fn() }
    jest.spyOn(axios, 'post').mockImplementation()
  })

  afterAll(() => {
    global.location = realLocation
  })

  const stubData = {
    "b-button": BButton,
    "b-card": BCard,
    "b-form": BForm,
    "b-form-datepicker": BFormDatepicker,
    "b-form-input": BFormInput,
    "b-form-group": BFormGroup,
    "b-form-invalid-feedback": BFormInvalidFeedback,
    "b-form-select": BFormSelect,
  }

  const propData = {
    options: [
      {
        id: 1,
        name: "Bucharest"
      }
    ]
  }

  it("Displays error when form fields are missing", async () => {

    const errors = {
      errors: {
        "name": ["Please choose a trip destination"],
        "city_id": ["The city id must be greater than 0."],
        "date_from":["Please choose a departing date"],
        "date_to":["Please choose an arrival date"]
      }
    }

    const wrapper = shallowMount(CreateTrip, {
      propsData: propData,
      stubs: stubData,
      mock: {
        axios: window.axios
      },
      data: function() {
        return {
          errors: {
            "name": ["Please choose a trip destination"],
            "city_id": ["The city id must be greater than 0."],
            "date_from":["Please choose a departing date"],
            "date_to":["Please choose an arrival date"]
          }
        }
      }
    })

    expect(wrapper.find('#date-to').element.disabled).toBe(true)
    axios.post.mockResolvedValue({data: errors})
    await wrapper.find("[type='submit']").trigger("click")

    const dateFrom = wrapper.find("#date-from__value_")
    const dateTo = wrapper.find("#date-to__value_")

    expect(dateFrom.find('.is-invalid').exists()).toBe(true)
    expect(dateTo.find('.is-invalid').exists()).toBe(true)
  })

  it("Redirects when form is submitted with no errors", async () => {

    const wrapper = shallowMount(CreateTrip, {
      propsData: propData,
      data: function() {
        return {
          city_id: 1,
          name: "tester",
          date_from: "2022-10-10",
          date_to: "2022-10-14",
        }
      },
      stubs: stubData,
      mock: {
        axios: window.axios
      }
    })

    wrapper.find("[type='submit']").trigger("click")

    axios.post.mockResolvedValue([{success:true,id:15}])

    expect(axios.post).toHaveBeenCalled()
  })

  it("Generates 14 days after the arrival date is populated", () => {

    const wrapper = shallowMount(CreateTrip, {
      propsData: propData,
      data: function() {
        return {
          form: {
            city_id: 1,
            name: "tester",
            date_from: "2022-10-10",
            date_to: "",
          }
        }
      },
      stubs: stubData
    })

    expect(wrapper.vm.maxDays()).toBe("2022-10-24")
  })
})