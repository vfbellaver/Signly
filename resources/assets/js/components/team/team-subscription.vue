<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Subscriptions</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-borderless m-b-none" v-cloak="true">
                    <tbody>
                    <tr v-for="(plan , index ) in plans" :class="{'first' : !index}">
                        <td><h3 class="text-uppercase"><strong>{{plan.name}}</strong></h3></td>
                        <td>
                            <button class="btn btn-default" type="button" @click="showFeatures(plan)">
                                <i class="fa fa-btn fa-star-o"></i>
                                Plan Features
                            </button>
                        </td>
                        <td>{{plan.price}} / {{plan.interval}}</td>
                        <td class="text-right" style="width: 134px;">
                            <button
                                    class="select btn btn-primary btn-outline"
                                    :class="{'active': planForm.stripe_plan == plan.id}"
                                    type="button" @click="choosePlan(plan)">
                                <i v-if="planForm.stripe_plan == plan.id" class="fa fa-check"></i>
                                <span v-if="planForm.stripe_plan == plan.id">Selected</span>
                                <span v-else>Select</span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <btn-submit class="btn btn-primary"
                            @click.native="updateSubscription"
                            :disabled="planForm.busy || planForm.stripe_plan == user.subscription.stripe_plan">
                    <spinner v-if="planForm.busy"></spinner>
                    <span>Update</span>
                </btn-submit>
                <div style="clear:both"></div>
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-content">
                <btn-danger style="margin-right: 10px" class="btn btn-danger"
                            @click.native="deleteSubscription" :disabled="userForm.busy">
                    <spinner v-if="userForm.busy"></spinner>
                    <span>Cancel Subscription</span>
                </btn-danger>
                <div style="clear: both"></div>
            </div>
        </div>
        <plan-modal :features="features" ref="terms"></plan-modal>
    </div>
</template>

<style lang="scss" scoped="scoped">
    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 0;
    }

    .ibox-content {
        clear: none;
        tr {
            td {
                border-top: none !important;
            }
        }
    }
</style>

<script>

    import * as SLC from "../../vue/http";
    import PlanModal from './plan-modal'

    export default {
        props: {},
        components: {
            PlanModal
        },

        data() {
            return {
                token: '',
                userForm: null,
                plans: [],
                planForm: null,
                features: null,
                user: window.Slc.user,
            }
        },

        created() {
            this.plans = Slc.plans;
            this.userForm = new SlcForm({
                id: this.user.id,
            });
            this.planForm = new SlcForm({
                stripe_plan: this.user.subscription.stripe_plan,
            });
        },

        watch: {},

        methods: {
            getToken() {
                let number = this.userForm.number;
                this.userForm.number = number.replace(/\s/g, "");

                const uri = laroute.route('api.payment.token');
                SLC.post(uri, this.userForm).then((response) => {
                    console.log('Get Token response', response.id);
                    this.userForm.source = response.id;
                });

            },

            showFeatures(plan) {
                this.features = plan.features;
                this.$refs.terms.show();
            },

            choosePlan(plan) {
                this.planForm.stripe_plan = plan.id;
                console.log('choosePlan ', plan.id);
            },

            deleteSubscription() {
                const uri = laroute.route("api.payment.delete.subscription", {user: this.userForm.id});
                SLC.delete(uri, this.userForm)
                    .then((response) => {
                        console.log('Subscription Deleted', response);
                    });
            },

            updateSubscription() {
                this.planForm.busy = true;
                SLC.sendForm('get', laroute.route("api.payment.update.subscription",
                    {plan: this.planForm.stripe_plan}), this.planForm)
                    .catch(() => {
                        this.planForm.busy = false;
                    })
                    .then((response) => {
                        console.log('Subscription Updated', response);
                        this.planForm.busy = false;
                    });
            },
        }
    }
</script>