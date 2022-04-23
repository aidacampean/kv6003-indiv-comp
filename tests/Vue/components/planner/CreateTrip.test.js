import { mount, shallow, shallowMount } from '@vue/test-utils'
import axios from "axios"
import { BButton, BCol, BCard, BForm, BFormDatepicker, BFormGroup, BFormInput, BFormInvalidFeedback, BFormSelect, BRow } from 'bootstrap-vue'
import CreateTrip from '@/planner/CreateTrip.vue'

jest.mock("axios")

describe('CreateTrip.vue', () => {

  const wrapper = shallowMount(CreateTrip, {
    propsData: {
      options: [
        {
          id: 1,
          name: "Bucharest"
        }
      ]
    },
    stubs: {
      'b-button': BButton,
      "b-col": BCol,
      'b-card': BCard,
      'b-form': BForm,
      'b-form-datepicker': BFormDatepicker,
      'b-form-input': BFormInput,
      'b-form-group': BFormGroup,
      'b-form-invalid-feedback': BFormInvalidFeedback,
      'b-form-select': BFormSelect,
      "b-row": BRow
    }
  });

  it('Displays error when form fields are missing', () => {
    wrapper.find('button').trigger('click')

    expect(wrapper.find('#city-feedback').isVisible()).toBe(true)
    expect(wrapper.find('#trip-name-feedback').isVisible()).toBe(true)
    expect(wrapper.find('#date-from-feedback').isVisible()).toBe(true)
    expect(wrapper.find('#date-to-feedback').isVisible()).toBe(true)
  })

  it('Redirects when form is submitted with no errors', () => {

    const dateFrom =  wrapper.find("#date-from")

    console.log(dateFrom)
//     dateFrom.setValue("2022-04-19")
//     wrapper.find("#date-to").setValue("2022-04-25")

//     expect(dateFrom.element.value).toBe("2022-04-19")
// console.log(wrapper.vm)
    //expect()

  })
}) 