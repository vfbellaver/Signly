
$('#payment').ready(function () {
    let stripe = Stripe('pk_test_o8pMqMjbYJLnpBp28U2ndxlJ');
    let elements = stripe.elements();

    form.addEventListener('submit',function (e) {

        e.preventDefaut();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                let msg = 'Error';
                Bus.$emit('card-erros',msg);
            } else {
                stripeTokenHandler(result.token);
            }
        });

    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        let form = document.getElementById('payment-form');
        let hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    };
});
