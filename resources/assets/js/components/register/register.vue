<template>
    <div id="register-page" class="container">
        <form id="register-form" class="form-horizontal" method="POST" @submit.prevent="submit">
            <row>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Subscription
                        </div>
                        <div class="panel-body">
                            <div class="form-group" :class="{'has-error': form.errors.has( 'plan' )}"
                                 :horizontal="true">
                                <div class="col-md-8 col-md-offset-4">
                                    <span class="help-block" v-show="form.errors.has( 'plan' )">
                                        {{ form.errors.get('plan') }}
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless m-b-none" v-cloak="true">
                                    <tbody>
                                    <tr v-for="plan in plans" :class="{'first' : !index}">
                                        <td class="text-uppercase"><strong>{{plan.name}}</strong></td>
                                        <td>
                                            <button class="btn btn-default" type="button"
                                                    @click="showPlanFeatures(plan)">
                                                <i class="fa fa-btn fa-star-o"></i>
                                                Plan Features
                                            </button>
                                        </td>
                                        <td>{{ plan.price}} / {{plan.interval}}</td>
                                        <td>{{ plan.trial_days }} Day Trial</td>
                                        <td class="text-right" style="width: 134px;">
                                            <button
                                                    class="select btn btn-primary btn-outline"
                                                    :class="{'active': form.plan && form.plan.id == plan.id}"
                                                    type="button" @click="form.plan = plan">
                                                <icon v-if="form.plan && form.plan.id == plan.id" icon="check"></icon>
                                                <span v-if="form.plan && form.plan.id == plan.id">Selected</span>
                                                <span v-else>Select</span>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-success">
                        <div class="panel-heading">Profile</div>
                        <div class="panel-body">
                            <form-group :form="form" field="company" :horizontal="true">
                                <input-label for="company" class="col-md-4">Company: </input-label>
                                <column size="8">
                                    <input-text v-model="form.company" id="company" name="company"></input-text>
                                </column>
                            </form-group>

                            <form-group :form="form" field="name" :horizontal="true">
                                <input-label for="name" class="col-md-4">Name: </input-label>
                                <column size="8">
                                    <input-text v-model="form.name" id="name" name="name"></input-text>
                                </column>
                            </form-group>

                            <form-group :form="form" field="email" :horizontal="true">
                                <input-label for="email" class="col-md-4">E-mail Address: </input-label>
                                <column size="8">
                                    <input-text v-model="form.email" id="email" name="email"></input-text>
                                </column>
                            </form-group>

                            <form-group :form="form" field="password" :horizontal="true">
                                <input-label for="password" class="col-md-4">Password: </input-label>
                                <column size="8">
                                    <input-password v-model="form.password" id="password"
                                                    name="password"></input-password>
                                </column>
                            </form-group>

                            <form-group :form="form" field="password_confirmation" :horizontal="true">
                                <input-label for="password_confirmation" class="col-md-4">
                                    Confirm Password:
                                </input-label>
                                <column size="8">
                                    <input-password v-model="form.password_confirmation" id="password_confirmation"
                                                    name="password_confirmation"></input-password>
                                </column>
                            </form-group>
                        </div>
                    </div>

                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Billing Information
                        </div>
                        <div class="panel-body">

                            <form-group :form="form" field="owner" :horizontal="true">
                                <input-label for="owner" class="col-md-4">Cardholder's Name: </input-label>
                                <column size="8">
                                    <input-text v-model="form.owner" id="owner" name="owner"></input-text>
                                </column>
                            </form-group>

                            <form-group :form="form" field="card" :horizontal="true" :class="{'has-error': cardError}">
                                <input-label for="card" class="col-md-4">Credit or debit card: </input-label>
                                <column size="8">
                                    <div id="card-element" class="form-control"></div>
                                    <div v-if="cardError" class="help-block">
                                        <strong>{{ cardError }}</strong>
                                    </div>
                                </column>
                            </form-group>

                            <hr/>

                            <form-group :form="form" field="terms_of_service" :horizontal="true">
                                <input-label for="terms_of_service" class="col-md-8 col-md-offset-4 text-left">
                                    <input name="terms_of_service" type="checkbox" v-model="form.terms_of_service"
                                           id="terms_of_service"/>
                                    I Accept The <a :href="urlTerms" target="_blank">Terms Of Service</a>
                                </input-label>
                            </form-group>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" :disabled="form.busy">
                                        <spinner v-if="form.busy"></spinner>
                                        Register
                                    </button>
                                    <a class="btn btn-default" :href="urlLogin">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </row>

        </form>

        <div ref="featuresModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" v-if="selectedPlan">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ selectedPlan.name }}</h4>
                    </div>

                    <div class="modal-body">
                        <ul>
                            <li><strong>Users</strong>{{" " + selectedPlan.features.users}}</li>
                            <li><strong>Billboards</strong>{{" " + selectedPlan.features.billboards}}</li>
                            <li><strong>Pdf's</strong>{{" " + selectedPlan.features.pdfs}}</li>
                            <li><strong>Proposals</strong>{{" " + selectedPlan.features.proposals}}</li>
                            <li><strong>Contracts</strong>{{" " + selectedPlan.features.contracts}}</li>
                            <li><strong>Scheduler</strong>{{" " + selectedPlan.features.scheduler}}</li>
                            <li><strong>White Label</strong>{{" " + selectedPlan.features.whiteLabel}}</li>
                            <li><strong>Value Monthly</strong>{{" " + selectedPlan.features.valueMonthly}}</li>
                            <li><strong>Value Annual</strong>{{" " + selectedPlan.features.valueAnnual}}</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: () => ({
            plans: 'Slc' in window ? Slc.plans : [],
            selectedPlan: null,
            cardError: null,
            form: new SlcForm({
                plan: null,
                company: null,
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                owner: null,
                source: null,
                terms_of_service: null
            })
        }),

        computed: {
            stripe() {
                return Stripe(window.Slc.stripeKey);
            },
            elements() {
                return this.stripe.elements();
            },
            card() {
                return this.elements.create('card', {style: {base: {lineHeight: '1.429'}}});
            },
            urlTerms() {
                return laroute.route('terms-of-service');
            },
            urlLogin() {
                return laroute.route('login');
            }
        },

        mounted() {
            let self = this;
            this.card.mount('#card-element');
            this.card.addEventListener('change', function (event) {
                console.info('Card on Change', event);
                self.cardError = event.error ? event.error.message : null;
            });
        },
        methods: {
            showPlanFeatures(plan) {
                this.selectedPlan = plan;
                $(this.$refs.featuresModal).modal('show');
            },
            submit() {
                let self = this;
                this.form.startProcessing();
                this.stripe.createToken(this.card)
                    .then(function (result) {
                        if (result.error) {
                            self.cardError = result.error.message;
                            self.form.finishProcessing();
                            return;
                        }
                        self.cardError = null;
                        self.form.source = result.token.id;

                        self.formSubmit();
                    });
            },
            formSubmit() {
                console.group('Form Submit');
                Slc.post(laroute.route('register-post'), this.form).then(() => {
                    window.location = '/';
                }).catch((response) => {
                    console.info('Error: ', response);
                });
                console.groupEnd('Form Submit');
            }
        }
    }
</script>

<style lang="scss">
    .help-block.col-md-offset-4 {
        margin-left: calc(33.33% + 15px);
    }

    .control-label.text-left {
        text-align: left !important;
    }

    .table.table-borderless {
        tr.first {
            td {
                border-top: none;
            }
        }
    }
</style>