require('./vendor');

import Utils from './commons/utils';
import Layout from './commons/layout';
import Laroute from './commons/laroute';
import axios from 'axios';
import Vue from 'vue';
import Moment from 'moment';
import MomentTZ from 'moment-timezone';

window.moment = Moment;
window.momentTZ = MomentTZ;
window.Utils = Utils();
window.Layout = Layout();
window.laroute = Laroute;
window.Vue = Vue;

require('./filters/bootstrap');
require('./directives/bootstrap');
require('./components/bootstrap');
require('./filters/bootstrap');
require('./vue/bootstrap');

window.EventBus = window.Bus = new Vue();

window.App = new Vue({
    el: '#app',

    data() {
        return {
            user: 'Slc' in window ? Slc.user : null,
            settings: 'Slc' in window ? Slc.settings : null,
            pageHeading: null,
            isMenuVisible: true
        }
    },

    created() {
        console.log("App Created");
        window.Layout.init();
        let self = this;

        EventBus.$on(['loadCurrentUser', 'userUpdated'], () => {
            axios.get(laroute.route('api.current.user'))
                .then(response => {
                    self.user = response.data;
                });
        });

        EventBus.$on('settingsUpdated', () => {
            axios.get(laroute.route('api.current.settings'))
                .then(response => {
                    self.user = response.data;
                });
        });
    },
});
