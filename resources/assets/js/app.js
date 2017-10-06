require('./vendor');

import Utils from './commons/utils';

window.Utils = Utils();

import Layout from './commons/layout';

window.Layout = Layout();

import Laroute from './commons/laroute';

window.laroute = Laroute;

window. Vue= require('vue');

require('./directives/bootstrap');
require('./components/bootstrap');

window.Bus = new Vue();
require('./vue/bootstrap');

import * as VueGoogleMaps from 'vue2-google-maps';

window.Vue.use(VueGoogleMaps, {
import * as VueGoogleMaps from 'vue2-google-maps';
import * as VueTimePicker from 'vue2-timepicker';

window.Vue.use(VueTimePicker);
window.Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyC2z5mUPBMQj4xb6VNzX32Iv-5xFzcpxu4',
        libraries:   'places',
    }
});


const app = new Vue({
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
    })
;
