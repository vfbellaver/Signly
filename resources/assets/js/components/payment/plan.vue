<template>
    <div>
        <div class="ibox-content">
            <a v-for="p in plans">
                <content-plan
                        @click.native="selectedPlan(p)"
                        :name="p.name"
                        :icon="p.icon"
                        :circle="p.select.circle"
                        :footer="p.select.footer"
                >
                </content-plan>
            </a>
            <input class="margin" name="plan" :value="planSelected" type="hidden"/>
            <div class="clear"></div>
        </div>
        <br>

        <div class="ibox-content" v-for="p in plans" v-if="p.select.selected">

            <div class="row">
                <div class="col-md-7">

                    <h2 class="font-bold m-b-xs">
                        {{p.name}}
                    </h2>

                    <h4>Product description</h4>

                    <dl class="m-t-md">
                        <dd>Users:<h4>{{" "+p.users}}</h4></dd>
                        <dd>Billboards:<h4>{{" "+p.billboards}}</h4></dd>
                        <dd>PDF's Created:<h4>{{" "+p.pdfs}}</h4></dd>
                        <dd>Contracts:<h4>{{" "+p.contracts}}</h4></dd>
                        <dd>Online Proposal:<h4>{{" "+p.proposals}}</h4></dd>
                        <dd>Scheduler:<h4>{{" "+p.scheduler}}</h4></dd>
                        <dd>White Label:<h4>{{" "+p.whiteLabel}}</h4></dd>
                    </dl>
                    <hr>
                    <div class="m-t-md">
                        <h2 class="product-main-price">{{"Annual Price: "+p.valueAnnual+" or Monthly Price: "+p.valueMonthly}}<small class="text-muted"></small> </h2>
                    </div>

                </div>
                <div class="col-md-5">
                    <img src="/images/enterprise.jpg" width="100%" style="margin-bottom: 5px">
                    <a class="btn btn-lg btn-success pull-right">
                        <i class="fa fa-plus"></i> JOIN US
                    </a>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</template>
<style>
    .clear{
        clear: both;
    }
</style>
<script>

    //import ContentPlan from "./content-plan";

    export default {

        component: {

        },
        created(){

        },


        data(){

            return {

                plans: [
                    {
                        name: 'ENTREPRISE TEAM',
                        id:'enterprise-team',
                        icon:'fa fa-users',
                        select:{
                            circle:'register-circle-disabled',
                            footer:'register-footer-disabled',
                            selected:false,
                        },
                        users: 'Custom',
                        billboards: 'Unlimited',
                        pdfs: 'Custom',
                        proposals: 'Custom',
                        contracts: 'Custom',
                        scheduler: 'Yes',
                        whiteLabel: 'Yes',
                        valueMonthly: 'Call For Quote',
                        valueAnnual: 'Call For Quote',
                        agree: false,
                    },
                    {
                        name: 'COMPANY TEAM',
                        id:'company-team',
                        icon:'fa fa-user-plus',
                        select:{
                            circle:'register-circle-disabled',
                            footer:'register-footer-disabled',
                            selected:false,
                        },
                        users: '10',
                        billboards: 'Unlimited',
                        pdfs: '100',
                        proposals: '100',
                        contracts: '20',
                        scheduler: 'Yes',
                        whiteLabel: 'Yes',
                        valueMonthly: '$499',
                        valueAnnual: '$499',
                        agree:false,
                    },
                    {
                        name: 'GROWING TEAM',
                        id:'growing-team',
                        icon:'fa fa-user-plus',
                        select:{
                            circle:'register-circle-disabled',
                            footer:'register-footer-disabled',
                            selected:false,
                        },
                        users: '5',
                        billboards: 'Unlimited',
                        pdfs: '50',
                        proposals: '50',
                        contracts: '10',
                        scheduler: 'No',
                        whiteLabel: 'No',
                        valueMonthly: '$399',
                        valueAnnual: '$349',
                        agree:false,
                    },
                    {
                        name: 'SOLO',
                        id:'solo-team',
                        icon:'fa fa-user',
                        select:{
                            circle:'register-circle-disabled',
                            footer:'register-footer-disabled',
                            selected:false,
                        },
                        users: '1',
                        billboards: '25',
                        pdfs: '20',
                        proposals: '0',
                        contracts: '0',
                        scheduler: 'No',
                        whiteLabel: 'No',
                        valueMonthly: '$299',
                        valueAnnual: '$249',
                        agree:false,
                    },
                ],

                planSelected: ''

            }
        },

        methods:{
            selectedPlan(plan){
                plan.select = {
                    circle:'register-circle',
                    footer:'register-footer',
                    selected:true,
                };

                this.planSelected = plan.id;
                this.updatePlans(plan);
            },

            updatePlans(planUpdate){

                this.plans.forEach(plan => {
                    if(plan.name != planUpdate.name){
                        plan.select = {
                                circle:'register-circle-disabled',
                                footer:'register-footer-disabled',
                                selected:false,
                        }
                        console.log('Plan name updated',plan.name);
                    }
                });
            }
        },


    }
</script>