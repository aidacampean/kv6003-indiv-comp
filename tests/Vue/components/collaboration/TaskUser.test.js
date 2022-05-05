import { mount, shallowMount } from "@vue/test-utils"
import Vue from 'vue'
import BootstrapVue from "bootstrap-vue"
import axios from "axios"
import Tasks from "@/collaboration/Tasks.vue"
import TaskUser from "@/collaboration/TaskUser.vue"
import "regenerator-runtime/runtime"

Vue.use(BootstrapVue)

describe("TaskUser.vue", () => {

    //save the original location so we can reassign afterwards to not affect other tests
    const realLocation = global.location

    beforeAll(() => {
        delete global.location
        global.location = { assign: jest.fn() }
        jest.spyOn(axios, 'post').mockImplementation()
        global.confirm = jest.fn(() => true);
    })

    afterAll(() => {
        global.location = realLocation
    })

    const propsData = {
        data: {
            id: 1,
            role: "admin",
            user: {
                id: 1,
                username: "test",
                email: "test@test.com",
            },
            task: []
        }
    };

    it("Tasks can be saved", async () => {
        const wrapper = shallowMount(TaskUser, {
            propsData: propsData,
            mock: {
              axios: window.axios
            },
        })

        axios.post.mockResolvedValue([{success:true}])
        wrapper.find("[type='submit']").trigger("click")
        await wrapper.vm.$nextTick()
        expect(axios.post).toHaveBeenCalled()
        expect(wrapper.find(".btn-secondary").exists()).toBe(false)
    })

    it("Disables when the task limit has been reached", () => {
        const wrapper = shallowMount(TaskUser, {
            parentComponent: Tasks,
            propsData: propsData,
            mock: {
              axios: window.axios
            },
        })

        const checked = {
            target: {
                checked: true
            }
        }

        wrapper.vm.checkLimits('hotel', checked)
        wrapper.vm.checkLimits('flight', checked)

        expect(wrapper.vm.$parent.hotelLimit).toBe(1)
        expect(wrapper.vm.$parent.flightLimit).toBe(1)

        wrapper.vm.checkLimits('flight', checked)

        expect(wrapper.vm.isDisabled('flight')).toBe(true)
    })

    it("Limit increments when unchecked", () => {
        const wrapper = shallowMount(TaskUser, {
            parentComponent: Tasks,
            propsData: propsData,
            mock: {
              axios: window.axios
            },
        })

        const checked = {
            target: {
                checked: true
            }
        }

        const unchecked = {
            target: {
                checked: false
            }
        }

        wrapper.vm.checkLimits('excursion', checked)
        expect(wrapper.vm.$parent.excursionLimit).toBe(1)
        wrapper.vm.checkLimits('excursion', unchecked)
        expect(wrapper.vm.$parent.excursionLimit).toBe(2)
    })

    it("Calculates limits when asccessing the collaboration page", () => {
        const data = {
            data: {
                id: 1,
                role: "admin",
                user: {
                    id: 1,
                    username: "test",
                    email: "test@test.com",
                },
                task: {
                    id: 1,
                    trip_id: 1,
                    collaborator_id: 2,
                    task1: "other",
                    task2: "flight"
                }
            }
        };

        const wrapper = shallowMount(TaskUser, {
            parentComponent: Tasks,
            propsData: data,
            mock: {
              axios: window.axios
            },
        })

        expect(wrapper.vm.$parent.otherLimit).toBe(1)
        expect(wrapper.vm.$parent.flightLimit).toBe(1)
        expect(wrapper.vm.form.selected.length).toBe(2)
    })

    it("A collaborator can be deleted", async () => {
        const data = {
            data: {
                id: 2,
                role: "collaborator",
                user: {
                    id: 2,
                    username: "collab",
                    email: "collab@test.com",
                },
                task: {
                    id: 1,
                    trip_id: 1,
                    collaborator_id: 2,
                    task1: "other",
                    task2: "flight"
                }
            }
        }

        const wrapper = mount(TaskUser, {
            parentCoponent: Tasks,
            propsData: data,
            mock: {
              axios: window.axios
            },
        })

        expect(wrapper.find(".btn-dark").exists()).toBe(true)
        axios.post.mockResolvedValue([{success:true}])
        wrapper.find(".btn-dark").trigger("click")
        await wrapper.vm.$nextTick()

        expect(global.confirm).toHaveBeenCalledWith("Delete this user?");
    })
})