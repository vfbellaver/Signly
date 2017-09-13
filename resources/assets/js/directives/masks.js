module.exports = function ($) {

    let tel = function (el) {
        setTimeout(_ => {
            let v = $(el).val();

            v = v.replace(/\D/g, "");

            if (!v) {
                $(el).val(v);
                return;
            }

            // (385) 236-7324
            v = v.replace(/^(\d{3})(\d)/, "($1) $2");
            v = v.replace(/^\((\d{3})\)\s(\d{3})(\d)/, "($1) $2-$3");

            $(el).val(v);
        },1);
    };

    return {
        tel
    };

}(window.jQuery);
