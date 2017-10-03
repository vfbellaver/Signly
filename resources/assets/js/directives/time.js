Vue.directive('time', {

    bind: function (el, binding) {

        $(el).attr('maxlength', 5);
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
                v = v.replace(/^0*/g, "");
                v = v.replace(/^(\d)$/, "0:0$1");
                v = v.replace(/^(\d{2})$/, "0:$1");
                v = v.replace(/(\d+)(\d{2})$/, "$1:$2");
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