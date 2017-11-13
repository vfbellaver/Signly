import Vue from 'vue';

Vue.filter('money', function (value, prefix) {
    let mask = function (v) {
        v = v.toString().replace(/[^0-9]/g, "");
        if (v === undefined || v === null || v.length === 0) {
            return "";
        }

        v = v.replace(/^0*/g, "");
        v = v.replace(/^$/, "0.00");
        v = v.replace(/^(\d)$/, "0.0$1");
        v = v.replace(/^(\d{2})$/, "0.$1");
        v = v.replace(/(\d+)(\d{2})$/, "$1.$2");
        for (let i = 0; i < 10; i++) {
            v = v.replace(/(\d)(\d{3}[.,])/, "$1,$2");
        }
        return v;
    };

    const result = mask(value);
    return prefix ? `${prefix} ${result}` : result;
});