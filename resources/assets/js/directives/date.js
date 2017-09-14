Vue.directive('date', {

    bind: function (el, binding) {

        $(el).attr('maxlength', 10);
        $(el).on('change', () => {
            setTimeout(mask, 1);
        });

        let mask = function () {
            let v = $(el).val();

            v = v.toString().replace(/[^0-9]/g, "");

            if (v === undefined || v === null) {
                return;
            }
            v = v.replace(/\D/g, "");
            if (v) {
                v = v.replace(/^(\d{2})(\d)/, "$1/$2");
                v = v.replace(/^(\d{2})\/(\d{2})(\d)/, "$1/$2/$3");
            }

            $(el).val(v);
            let event = new Event('input', {bubbles: true});
            el.value = v;
            el.dispatchEvent(event);
        };

        $(el).keypress(() => {
            setTimeout(mask, 1);
        });

        mask();
    },

});