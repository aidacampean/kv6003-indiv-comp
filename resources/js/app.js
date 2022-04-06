require('./bootstrap');

import Vue from 'vue';
import moment from 'moment'
import BootstrapVue from 'bootstrap-vue';
import '../sass/main.scss';

// import {     
//     BAlert,
//     BButton,
//     BCard,
//     BCardTitle,
//     BCardText,
//     BCol,
//     BContainer,
//     BDropdown,
//     BDropdownItem,
//     BForm,
//     BFormSelect,
//     BModal,
//     BNavbar,
//     BNavbarNav,
//     //BNavbarBrand,
//     BNavbarToggle,
//     BRow,
//     BToast,
//     BToaster
// } from "bootstrap-vue";

Vue.config.productionTip = false;
Vue.use(BootstrapVue)

window.Vue = require('vue').default;

// mine - have to be referenced globally to be used in blade 
Vue.component('assign-tasks', require('./components/collaboration/AssignTasks.vue').default);
Vue.component('create-trip', require('./components/CreateTrip.vue').default);
Vue.component('create-itinerary', require('./components/itinerary/CreateItinerary.vue').default);
Vue.component('days', require('./components/itinerary/Days.vue').default);
Vue.component('FormError', require('./components/FormError.vue').default);
Vue.component('toast', require('./components/itinerary/Toast.vue').default);
//Vue.component('summary', require('./components/itinerary/Summary.vue').default);
Vue.component('user', require('./components/collaboration/User.vue').default);



// vue
// Vue.component('b-alert', BAlert);
// Vue.component('b-button', BButton);
// Vue.component('b-card', BCard);
// Vue.component('b-card-title', BCardTitle);
// Vue.component('b-card-text', BCardText);
// Vue.component('b-col', BCol);
// Vue.component('b-container', BContainer);
// Vue.component('b-dropwdown', BDropdown);
// Vue.component('b-dropwdown-item', BDropdownItem);
// Vue.component('b-form', BForm);
// Vue.component('b-form-select', BFormSelect);
// Vue.component('b-row', BRow);
// Vue.component('b-modal', BModal);
// Vue.component('b-navbar', BNavbar);
// Vue.component('b-navbar-nav', BNavbarNav);
// //Vue.component('b-navbar-brand', BNavbarBrand);
// Vue.component('b-navbar-toggle', BNavbarToggle);
// Vue.component('b-toast', BToast);
// Vue.component('b-toaster', BToaster);

//make a vue filter available for use globally
Vue.filter('formatDate', function(value) {
    if (value) {
      return moment(String(value)).format('DD/MM/YYYY')
    }
  });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
