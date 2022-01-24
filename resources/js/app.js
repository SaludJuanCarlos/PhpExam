require('./bootstrap');

import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { Link } from '@inertiajs/inertia-vue'
import moment from 'moment'
import moment_timezone from 'moment-timezone'
import JwPagination from 'jw-vue-pagination'
import 'vue-datepicker-ui/lib/vuedatepickerui.css';
import VueDatepickerUi from 'vue-datepicker-ui';

Vue.use(BootstrapVue);
Vue.use(InertiaApp);
Vue.component('inertia-link', Link);
Vue.component('Datepicker', VueDatepickerUi);
Vue.component('jw-pagination', JwPagination);
const app = document.getElementById('app')
moment.tz.setDefault('UTC')

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,

    },
  }),
}).$mount(app)