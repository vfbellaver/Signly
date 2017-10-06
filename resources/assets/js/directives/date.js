Vue.directive('date', {

    bind: function (el, binding) {

        $(el).attr('maxlength', 10);
        $(el).on('change', () => {
            setTimeout(mask, 1);
        });

        let mask = function () {
            v.mask('00:00');

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