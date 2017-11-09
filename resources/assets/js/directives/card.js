Vue.directive('card', {

    bind: function (el) {

        $(el).attr('maxlength', 19);
        let mask = function () {
            let v = $(el).val();
            v = v.toString().replace(/^\D/g,"");
            if (v === undefined || v === null || v.length === 0) {
                return " ";
            }

            v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
            v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3");
            v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3 $4");


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