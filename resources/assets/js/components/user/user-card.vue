<template>
    <div>
        <form-submit v-model="userForm" @submit="getToken">
            <h2><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                {{" Card ***********" + userForm.card_last_four + "    "}}
                <small><strong>Card Brand:</strong> {{" " + userForm.brand}}</small>
            </h2>
            <div class="divider"></div>
            <column size="12">
                <form-group :form="userForm" field="name">
                    <input-label for="name">Cardholder's Name: </input-label>
                    <input-text v-model="userForm.name" id="name"
                                name="name"></input-text>
                </form-group>
            </column>
            <column size="12">
                <form-group :form="userForm" field="number">
                    <input-label for="card_number">Card Number: </input-label>
                    <input-text v-model="userForm.number" id="number"
                                placeholder="**** **** **** ****" name="number" v-card></input-text>
                </form-group>
            </column>
            <column size="4">
                <form-group :form="userForm" field="cvc">
                    <input-label for="cvc">Security Code : </input-label>
                    <input-password text="number" max="3" v-model="userForm.cvc" id="cvc"
                                    placeholder="***" name="cvc" v-cvc></input-password>
                </form-group>
            </column>
            <column size="2">
                <form-group :form="userForm" field="exp_month">
                    <input-label for="exp_month">Month: </input-label>
                    <input-password v-model="userForm.exp_month" id="exp_month"
                                    placeholder="mm" name="exp_month" maxlength="2"></input-password>
                </form-group>
            </column>
            <column size="2">
                <form-group :form="userForm" field="exp_year">
                    <input-label for="exp_year">Year: </input-label>
                    <input-password v-model="userForm.exp_year" id="exp_year"
                                    placeholder="AAAA" name="exp_year" maxlength="4"></input-password>
                </form-group>
            </column>

            <column size="4">
                <form-group :form="userForm" field="address_zip">
                    <input-label for="exp_date">Zip Code: </input-label>
                    <input-password v-model="userForm.address_zip" id="address_zip"
                                    placeholder="*****" name="address_zip" v-zipcode></input-password>
                </form-group>
            </column>

            <div class="col-md-12">
                <hr>
                <btn-submit :disabled="userForm.busy">
                    <spinner v-if="userForm.busy"></spinner>
                </btn-submit>
            </div>
        </form-submit>

        <hr>
    </div>
</template>

<style>
    .divider {
        height: 3px;
        margin: 15px;
        background-color: rgba(2, 118, 160, 0.74);
        border-radius: 3px 3px 3px 3px;
    }
</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
            user: {required: true},
        },
        components: {},

        data() {
            return {
                userForm: null,
                card: [],
                token: ''
            }
        },

        created() {
            this.reload();
            this.buildForm();
        },

        watch: {
            'userForm.card_name': function () {
                if (this.card.name != null) {
                    this.userForm.card_name = this.card.name;
                }
            }
        },

        methods: {

            reload() {
                let self = this;
                Slc.get(laroute.route('api.payment.card'))

                    .then((response) => {
                        console.log('get Card ', response.data[0]);
                        self.card = response.data[0];
                        self.userForm.card_name = self.card.name;
                    });
            },

            getToken(){

                let number = this.userForm.number;
                this.userForm.number = number.replace(/\s/g,"");

                const uri = laroute.route('api.payment.token');
                Slc.post(uri, this.userForm).then((response) => {
                    this.userForm.source = response.id;
                    this.updateCard(this.userForm);
                });

            },

            updateCard(form){
                const uri = laroute.route('api.payment.update.card');
                Slc.post(uri, form).then((response) => {
                    console.log('update card', response);
                    this.buildForm();
                    this.reload();
                    self.userForm.card_name = self.card.name;
                });
            },

            buildForm(){
                this.userForm = new SlcForm({
                    stripe_id: this.user.stripe_id,
                    number: '',
                    source: '',
                    brand: this.user.card_brand,
                    trial_ends_at: this.user.trial_ends_at,
                    card_last_four: this.user.card_last_four,
                    name: null,
                    cvc: null,
                    exp_month: null,
                    exp_year: null,
                    address_zip: null,
                });
            }
        }
    }
</script>