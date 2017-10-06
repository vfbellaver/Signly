require('./vendor');

import Utils from './commons/utils';
import Layout from './commons/layout';
import Laroute from './commons/laroute';
import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';

window.Utils = Utils();
window.Layout = Layout();
window.laroute = Laroute;
window.Vue = Vue;

//window.Bus = new Vue();

require('./directives/bootstrap');
require('./components/bootstrap');
require('./vue/bootstrap');

Vue.use(VueGoogleMaps, {
import * as VueGoogleMaps from 'vue2-google-maps';
import * as VueTimePicker from 'vue2-timepicker';

window.Vue.use(VueTimePicker);
window.Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyC2z5mUPBMQj4xb6VNzX32Iv-5xFzcpxu4',
        libraries:   'places',
    }
});

window.Bus = new Vue({
    el: '#app',

    data() {
        return {
            user: 'Slc' in window ? Slc.user : null,
            isMenuVisible: true,
        }
    },

    created() {
        console.log("App Created");
        window.Layout.init();
        let self = this;
        Bus.$on('loadCurrentUser', () => {
            axios.get(laroute.route('api.current.user'))
                .then(response => {
                    self.user = response.data;
                });
        });
    },
});
