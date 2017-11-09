Vue.directive('zipcode', {

    bind: function (el) {

        $(el).attr('maxlength', 5);

        let mask = function () {
            let v = $(el).val();
            v = v.toString().replace(/^\D/g,"");
            if (v === undefined || v === null || v.length === 0) {
                return "";
            }

            v = v.replace(/^(\d{5})/g, "$1");

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

});