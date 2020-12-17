require('./bootstrap');

require('moment');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'; 

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueSweetalert2);

const app = document.getElementById('app');

new Vue({
    metaInfo: {
      titleTemplate: (title) => title ? `${title} - demo` : 'demo'
    },
    render: h => h(InertiaApp, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
      },
    }), 
  }).$mount(app) 
