Vue.directive('number', {

    bind: function (el) {

        let mask = function () {
            let v = $(el).val();
            v = v.toString().replace(/^\D/g, "");
            if (v === undefined || v === null || v.length === 0) {
                return " ";
            }

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
    },

});