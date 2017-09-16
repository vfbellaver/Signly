require('./vendor');

import Utils from './commons/utils';
window.Utils = Utils();

import Layout from './commons/layout';
window.Layout = Layout();

import Laroute from './commons/laroute';
window.laroute = Laroute;

window.Maps = require('./maps');
window.Masks = require('./masks');

window.Vue = require('vue');

require('./directives/bootstrap');
require('./components/bootstrap');

window.Bus = new Vue();
require('./vue/bootstrap');

import * as VueGoogleMaps from 'vue2-google-maps';

window.Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyC2z5mUPBMQj4xb6VNzX32Iv-5xFzcpxu4',
        v: 'v=3', //Optional
        libraries: 'places', //// If you need to use place input
    }
});

window.Masks = require ('./masks');

const app = new Vue({
        el: '#app',

        data(){
            return {
                user: 'Slc' in window ? Slc.user : null,
                isMenuVisible: true,
            }
        },

        created()
        {
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
