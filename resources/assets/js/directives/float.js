Vue.directive('float', {

    bind: function (el, binding) {

        let mask = function () {
            let v = $(el).val();
            v = v.toString().replace(/[^0-9]/g, "");
            if (v === undefined || v === null || v.length === 0) {
                return "";
            }

            v = v.replace(/^0*/g, "");
            v = v.replace(/^$/, "0.00");
            v = v.replace(/^(\d)$/, "0.0$1");
            v = v.replace(/^(\d{2})$/, "0.$1");
            v = v.replace(/(\d+)(\d{2})$/, "$1.$2");

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