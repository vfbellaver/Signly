<template>
    <div>
        <table class="table table-borderless m-b-none" v-cloak="true">
            <tbody>
            <tr v-for="(plan , index ) in plans">
                <td><strong>{{plan.name}}</strong></td>
                <td>
                    <button class="btn btn-default" type="button" @click="showPlanFeatures(plan)">
                        <i class="fa fa-btn fa-star-o"></i>
                        Plan Features
                    </button>
                </td>
                <td>{{plan.price}} / {{plan.interval}}</td>
                <td>{{ plan.trial_days }} Day Trial</td>
                <td class="text-right" style="width: 134px;">
                    <button
                            class="select btn btn-primary btn-outline"
                            :class="{'active': chosenPlan == plan.id}"
                            type="button" @click="choosePlan(plan)">
                        <i v-if="chosenPlan == plan.id" class="fa fa-check"></i>
                        Select
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <input ref="selectedPlan" type="hidden" name="plan"/>
    </div>
</template>

<style>

</style>

<script>

    import * as SLC from "../../vue/http";

    export default {
        props: {

        },
        components: {},

        data() {
            return {
                userForm: null,
                chosenPlan: null,
                card: [],
                token: '',
                plans: []

            }
        },

        created() {
            this.reload();
            this.plans = Slc.plans;
        },

        watch: {

        },

        methods: {

            reload() {
                let self = this;
                SLC.get(laroute.route('api.payment.card'))
                    .then((response) => {
                        console.log('get Card ', response.data[0]);
                        self.card = response.data[0];
                    });
            },

            getToken(){

                let number = this.userForm.number;
                this.userForm.number = number.replace(/\s/g, "");

                const uri = laroute.route('api.payment.token');
                SLC.post(uri, this.userForm).then((response) => {
                    console.log('Get Token response', response.id);
                    this.userForm.source = response.id;
                });

            },

            showPlanFeatures(plan){
                this.chosenPlan = plan.id;
                console.log('showPlanFeatures ', plan);
            },

            choosePlan(plan){
                this.chosenPlan = plan.id;
                console.log('choosePlan ', plan.id);
            },
        }
    }
</script>