import moment from 'moment';
import Vue from 'vue';

Vue.filter('date', function (value, pattern) {
    if (!value) {
        return '';
    }
    return moment(String(value)).format(pattern ? pattern : 'MM/DD/YYYY hh:mm');
});