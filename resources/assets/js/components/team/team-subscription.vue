<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Subscription</h5>
            </div>
            <div class="ibox-content">
                <btn-danger style="margin-right: 10px" class="btn btn-danger"
                            @click.native="deleteSubscription" :disabled="userForm.busy">
                    <spinner v-if="userForm.busy"></spinner>
                    <span>Cancel Subscription</span>
                </btn-danger>
            </div>
        </div>
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
        props     : {},
        components: {
            PlanModal
        },

        data() {
            return {
                token   : '',
                userForm: null,
                plans   : [],
                planForm: null,
                features: null,
                user    : window.Slc.user,
            }
        },

        created() {
            this.reload();
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

            reload() {
                let self = this;
                SLC.get(laroute.route('api.payment.card'))
                    .then((response) => {
                        console.log('get Card ', response.data[0]);
                        self.card = response.data[0];
                    });
            },

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
                SLC.put(laroute.route("api.payment.update.subscription"), this.planForm)
                    .then((response) => {
                        console.log('Subscription Updated', response);
                        this.planForm.busy = false;
                    });
            },
        }
    }
</script>