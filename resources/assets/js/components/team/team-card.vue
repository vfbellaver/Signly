<template>
    <div>
        <row>
            <div class="col-xs-6 col-sm-6">
                <div class="payment-card">
                    <i :class="brand"></i>
                    <h2>
                        **** **** **** {{currentCard.last4}}
                    </h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <small>
                                <strong>Expiry date:</strong> {{currentCard.exp_month}}/{{currentCard.exp_year}}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small>
                                <strong>Name:</strong> {{currentCard.name}}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </row>
        <row>
            <div class="col-xs-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Update your Card</h5>
                    </div>
                    <div class="ibox-body-card">
                        <form-submit v-model="userForm" @submit="createToken">
                            <column size="12">
                                <form-group :form="userForm" field="owner">
                                    <input-label for="owner">Cardholder's Name: </input-label>
                                    <input-text v-model="userForm.owner" id="owner"
                                                name="owner"></input-text>
                                </form-group>
                            </column>
                            <hr>
                            <column size="12">
                                <div ref="card" class="form-control"></div>
                                <hr class="hr">
                                <button class="btn btn-success" @click="createToken">
                                    Update Card
                                </button>
                            </column>
                        </form-submit>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>
        </row>
    </div>
</template>
<style lang="scss" scoped="scoped">
    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 0;
    }

    .ibox-body-card {
        background-color: white;
        height: 227px;
        margin-top: 2px;
        padding: 10px 20px 20px 20px;
    }

    .row:before, .row:after {
        content: " ";
        display: none;
    }

    .hr {
        margin-top: 16px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eeeeee;
    }

    .payment-card {
        height: 177px
    }
</style>
<script>

    import * as SLC from '../../vue/http';

    export default {

        data(){
            return {
                userForm: null,
                cardBrand: [
                    {name: 'Visa', class: 'fa fa-cc-visa payment-icon-big text-success'},
                    {name: 'MasterCard', class: 'fa fa-cc-mastercard payment-icon-big text-success'},
                    {name: 'Diners Club', class: 'fa fa-cc-diners-club payment-icon-big text-success'},
                    {name: 'American Express', class: 'fa fa-cc-visa payment-icon-big text-success'},
                    {name: 'Discovery', class: 'fa fa-cc-discover payment-icon-big text-success'},
                    {name: 'JCB', class: 'fa fa-cc-jcb payment-icon-big text-success'},
                ],
                brand: null,
                stripe: null,
                token: null,
                card: null,
                currentCard: []
            }
        },

        created(){
            this.getCard();
            this.buildForm();
        },

        mounted(){
            this.stripe = Stripe(window.Slc.stripeKey);
            const elements = this.stripe.elements();
            this.card = elements.create('card', {style: {base: {lineHeight: '1.429'}}});
            this.card.mount(this.$refs.card);

            this.card.addEventListener('change', function (event) {
                if (event.error) {
                    console.log('Error', event);
                }
            });
        },

        watch: {
            'userForm.owner': function () {
                if (this.currentCard.name != null) {
                    this.userForm.owner = this.currentCard.name;
                    this.getBrandCard(this.currentCard.brand);
                }
            },
        },

        methods: {

            getCard() {
                let self = this;
                SLC.get(laroute.route('api.payment.card'))
                    .then((response) => {
                        console.log('get Card ', response.data[0]);
                        self.currentCard = response.data[0];
                        self.userForm.owner = self.currentCard.name;
                    });
            },

            getBrandCard(flag){
                for(let i = 0; i < this.cardBrand.length; i++){
                    if (this.cardBrand[i].name === flag) {
                        this.brand = this.cardBrand[i].class;
                    }
                };
            },

            createToken()
            {
                const self = this;
                this.stripe.createToken(this.card).then(function (result) {
                    if (result.error) {
                        console.log('Error Token', result);
                        return;
                    }
                    self.token = result.token.id;
                    self.buildForm();
                    self.updateCard();
                });
            },

            updateCard()
            {
                const self = this;
                const uri = laroute.route('api.payment.update.card');
                SLC.post(uri, this.userForm).then((response) => {
                    console.log('update card', response);
                    self.buildForm();
                });
            },

            buildForm()
            {
                this.userForm = new SlcForm({
                    source: this.token,
                    owner: this.currentCard.name,
                });
            },

        }


    }
</script>