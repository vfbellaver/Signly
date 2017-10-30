<template>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Choose Your Plan</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
                </a>
            </div>
        </div>
        <div class="ibox-content text-left">
            <div v-if="page1">
                <plan @pay="step"></plan>
            </div>
            <div v-if="page2">
                <payment-form @verify="userCard" :plan="plan"></payment-form>
            </div>
            <div v-if="page3">
                <user-card :user-verify="userVerify"></user-card>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</template>
<style>
    .clear{
        clear: both;
    }
</style>
<script>

    import PaymentForm from './payment-form';
    import UserCard from '../user/user-card';

    export default {

        components: {
            PaymentForm,
            UserCard
        },


        computed: {

        },


        created(){

        },


        data(){

            return {
                page1: true,
                page2: false,
                page3: false,
                plan: '',
                userVerify: '',
                register: [],
            }
        },


        methods: {
            step(plan){
                console.log('plan register',plan.plan);
                this.page1 = false;
                this.page2 = true;
                this.plan = plan.plan;
            },

            userCard(user){
                console.log('User verify',user);
                this.userVerify = user;
                this.page2 = false;
                this.page3 = true;
            }
        },


    }
</script>