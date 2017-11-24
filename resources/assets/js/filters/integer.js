import Vue from 'vue';

Vue.filter('integer', function (value, prefix) {

    if (!value) {
        return '';
    }

    prefix = (prefix) ? `${prefix} ` : '';

    const mask = function (v) {
        if (!v) {
            return "";
        }

        v = v.toString().replace(/[^0-9.]/g, "");
        if (!v) {
            return "";
        }
        console.log('without cents');

        v = v.replace(/^$/, "0");
        v = v.replace(/([\d+,])(\.\d*)$/, "$1");
        v = v.replace(/^(0*)(\d+)$/, "$2");
        v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

        return `${prefix}${v}`;
    };

    return mask(value);
});