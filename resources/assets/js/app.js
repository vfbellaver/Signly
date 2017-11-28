require('./vendor');

import Utils from './commons/utils';
import Layout from './commons/layout';
import Laroute from './commons/laroute';
import axios from 'axios';
import Vue from 'vue';
import Moment from 'moment';
import MomentTZ from 'moment-timezone';
import Echo from "laravel-echo";

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

window.Pusher = require('pusher-js');
Pusher.logToConsole = true;

if (window.Slc.pusher) {
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: window.Slc.pusher,
        cluster: 'us2',
    });
}

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

        if (window.Slc.pusher && this.user && this.user.id) {
            window.Echo.private(`App.Team.${this.user.id}`)
                .listen('CommentCreated', (e) => {
                    console.log("Event", e);
                    EventBus.$emit('CommentCreated', e);
                });
        }
    },
});
