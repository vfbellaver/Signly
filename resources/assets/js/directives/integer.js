import Vue from "vue";

Vue.directive('integer', {

    bind: function (el, binding) {
        $(el).attr('maxlength', 11);
        const mask = function () {
            let v = $(el).val();
            v = v.toString().replace(/[^0-9]/g, "");
            if (v === undefined || v === null || v.length === 0) {
                return "";
            }

            v = v.replace(/^$/, "0");
            v = v.replace(/([\d+,])(\.\d*)$/, "$1");
            v = v.replace(/^(0*)(\d+)$/, "$2");
            v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

            $(el).val(v);
            let event = new Event('input', {bubbles: true});
            el.value = v;
            el.dispatchEvent(event);
        };

        $(el).change(() => {
            setTimeout(mask, 1);
        });
        $(el).keydown(() => {
            $(el).trigger('change');
        });

        mask();
    },

    update: function (el, binding) {
        $(el).trigger('change');
    },

});
