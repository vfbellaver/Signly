require('./vendor');

import Utils from './commons/utils';
import * as VueGoogleMaps from 'vue2-google-maps';
import * as VueTimePicker from 'vue2-timepicker';
import Layout from './commons/layout';
import Laroute from './commons/laroute';
import axios from 'axios';
import Vue from 'vue';
import Moment from 'moment';

window.moment = Moment;
window.Utils = Utils();
window.Layout = Layout();
window.laroute = Laroute;
window.Vue = Vue;

require('./directives/bootstrap');
require('./components/bootstrap');
require('./vue/bootstrap');

window.Vue.use(VueTimePicker);
window.Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCWnwChz7xUIhLTX2PfVd6AUlaReHBCu-Y',
        libraries: 'places',
    },
    installComponents: true,
});

window.EventBus = window.Bus = new Vue();

window.App = new Vue({
    el: '#app',

    data() {
        return {
            user: 'Slc' in window ? Slc.user : null,
            settings: 'Slc' in window ? Slc.settings : null,
            pageHeading: null,
            isMenuVisible: true,
            plans: 'Slc' in window ? Slc.plans : [],
            selectedPlan: null,
            chosenPlan: null,
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

    methods: {
        showPlanFeatures(plan) {
            this.selectedPlan = plan;
            $(this.$refs.featuresModal).modal('show');
        },
        choosePlan(plan) {
            this.chosenPlan = plan;
            $(this.$refs.selectedPlan).val(plan.id);
        }
    }
});
