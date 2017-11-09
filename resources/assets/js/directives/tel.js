Vue.directive('tel', {

    bind: function (el, binding) {

        $(el).attr('maxlength', 14);

        let mask = function () {
            let v = $(el).val();
            v = v.toString().replace(/^\D/g,"");

            if (v === undefined || v === null || v.length === 0) {
                return "";
            }
            v = v.toString().replace(/\D/g,"");
            v = v.replace(/^(\d{3})(\d)/g, "($1) $2");
            v = v.replace(/^(\(\d{3}\)\s)(\d{3})(\d)/, "$1$2-$3");
            v = v.replace(/^(\(\d{3}\)\s)(\d{3})-(\d{4})/, "$1$2-$3");

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