<template>
    <div>
        <row>
            <div class="col-xs-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Subscribe</h5>
                    </div>
                    <div class="ibox-body-card" :class="classError">
                        <form-submit v-model="userForm" @submit="createToken">
                            <column size="12">
                                <h3>$ 200.00/Mo</h3>
                            </column>
                            <column size="12">
                                <form-group :form="userForm" field="owner">
                                    <input-label for="owner">Cardholder's Name: </input-label>
                                    <input-text v-model="userForm.owner" id="owner"
                                                name="owner"></input-text>
                                </form-group>
                            </column>
                            <hr>
                            <column size="12">
                                <div class="form-group" :class="{'has-error': cardError}">
                                    <div ref="card" class="form-control"></div>
                                    <div v-if="cardError" class="help-block">
                                        <strong>{{ cardError }}</strong>
                                    </div>
                                </div>
                                <hr class="hr">
                                <button class="btn btn-primary" :disabled="userForm.busy">
                                    <spinner v-if="userForm.busy"></spinner>
                                    Subscribe
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
        min-height: 239px;
        margin-top: 2px;
        padding: 10px 20px 20px 20px;
    }

    .ibox-body-card-msg {
        background-color: white;
        height: 262px;
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
        data() {
            return {
                userForm   : null,
                stripe     : null,
                token      : null,
                card       : null,
                cardError  : null,
                currentCard: []
            }
        },

        computed: {

            classError() {
                if (this.cardError) {
                    return 'ibox-body-card-msg';
                } else {
                    return 'ibox-body-card';
                }
            }

        },

        created() {
            this.buildForm();
        },

        mounted() {
            this.buildFormStripe();
        },

        methods: {
            buildFormStripe() {
                this.stripe = Stripe(window.Slc.stripeKey);
                const elements = this.stripe.elements();
                this.card = elements.create('card', {style: {base: {lineHeight: '1.429'}}});
                this.card.mount(this.$refs.card);
                const self = this;
                this.card.addEventListener('change', function (event) {
                    if (event.error) {
                        self.cardError = event.error ? event.error.message : null
                    } else {
                        self.cardError = null;
                    }
                });
            },

            getBrandCard(flag) {
                for (let i = 0; i < this.cardBrand.length; i++) {
                    if (this.cardBrand[i].name === flag) {
                        this.brand = this.cardBrand[i].class;
                    }
                }
            },

            createToken() {
                const self = this;
                this.userForm.startProcessing();
                this.stripe.createToken(this.card).then(function (result) {
                    if (result.error) {
                        console.log('Error Token', result);
                        self.cardError = result.error.message;
                        self.userForm.finishProcessing();
                        return;
                    }

                    self.userForm.source = result.token.id;
                    self.subscribe();
                });
            },

            subscribe() {
                const uri = laroute.route('api.subscribe');
                SLC.post(uri, this.userForm).then((response) => {
                    console.log('update card', response);
                    window.location = laroute.route('team.settings');
                });
            },

            buildForm() {
                this.userForm = new SlcForm({
                    source: null,
                    owner : '',
                });
            },
        }
    }
</script>