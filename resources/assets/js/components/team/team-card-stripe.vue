<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Update your Card</h5>
            </div>
            <div class="ibox-content">
                <form-submit v-model="userForm" @submit="createToken">
                    <column size="12">
                        <form-group :form="userForm" field="owner">
                            <input-label for="owner">Cardholder's Name: </input-label>
                            <input-text v-model="userForm.owner" id="owner"
                                        name="owner"></input-text>
                        </form-group>
                    </column>
                    <column size="12">
                        <div ref="card" class="form-control"></div>
                        <hr>
                        <button class="select btn btn-success btn-outline pull-right pull-right" @click="createToken">
                            UPDATE CARD
                        </button>
                    </column>
                </form-submit>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</template>
<style>
    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 0;
    }

    .ibox-content {
        clear: none;
    }
</style>
<script>

    import * as SLC from '../../vue/http';

    export default {

        data(){
            return {
                userForm: null,
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
                }
            }
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

            createToken(){
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

            updateCard(){
                const self = this;
                const uri = laroute.route('api.payment.update.card');
                SLC.post(uri, this.userForm).then((response) => {
                    console.log('update card', response);
                    self.buildForm();
                });
            },

            buildForm(){
                this.userForm = new SlcForm({
                    source: this.token,
                    owner: this.currentCard.name,
                });
            }

        }


    }
</script>