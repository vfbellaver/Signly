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

        <div class="ibox-content p-xl" v-for="p in plans" v-if="p.select.selected">
                <div class="col-sm-3">
                    <h2>{{p.name}}</h2>
                    <address>
                        <strong>Details.</strong><br>
                        {{"Scheduler: " + p.scheduler}}<br>
                        {{"White Label: " + p.whiteLabel}}<br>
                    </address>
                    <p>
                        <span><strong>Invoice Date: </strong><span v-text="dateNow"></span></span><br>
                        <span><strong>Due Date:</strong> <span v-text="dateDue"></span></span>
                    </p>
                </div>

                <div class="col-sm-9">
                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                            <tr>
                                <th>Billboards</th>
                                <th>Users</th>
                                <th>PDF's Created</th>
                                <th>Online Proposals</th>
                                <th>Of Contracts</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <small>
                                        <strong>Total Billboards:</strong>   {{"   "+p.billboards}}
                                    </small>
                                </td>
                                <td>{{p.users}}</td>
                                <td>{{p.pdfs}}</td>
                                <td>{{p.proposals}}</td>
                                <td>{{p.contracts}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /table-responsive -->

                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Monthly Price :</strong></td>
                            <td>{{p.valueMonthly}}</td>
                        </tr>
                        <tr>
                            <td><strong>Annual Price :</strong></td>
                            <td>{{p.valueAnnual}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a @click="showTerms(p)" class="btn btn-primary">Terms</a>
                    </div>
                </div>
            <div class="clear"></div>
        </div>
        <plan-modal :id="id" :title="title" :term="term" ref="terms" @saved="agreeText"></plan-modal>
        <div class="clear"></div>
    </div>
</template>
<style>
    .clear {
        clear: both;
    }
</style>
<script>

    //import ContentPlan from "./content-plan";
    import ModalForm from '../shared/Mixins/ModalForm';
    import PlanModal from './plan-modal';

    export default {

        component: {
            ModalForm,
            PlanModal
        },


        computed: {
            dateNow(){
                return moment().format('L');
            },

            dateDue(){
                return moment().add(14,'days').calendar();
            },
        },

        created(){

        },


        data(){

            return {

                plans: [
                    {
                        name: 'ENTREPRISE TEAM',
                        id: 'enterprise-team',
                        icon: 'fa fa-star',
                        select: {
                            circle: 'register-circle-disabled',
                            footer: 'register-footer-disabled',
                            selected: false,
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
                        id: 'company-team',
                        icon: 'fa fa-users',
                        select: {
                            circle: 'register-circle-disabled',
                            footer: 'register-footer-disabled',
                            selected: false,
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
                        agree: false,
                    },
                    {
                        name: 'GROWING TEAM',
                        id: 'growing-team',
                        icon: 'fa fa-user-plus',
                        select: {
                            circle: 'register-circle-disabled',
                            footer: 'register-footer-disabled',
                            selected: false,
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
                        agree: false,
                    },
                    {
                        name: 'SOLO',
                        id: 'solo-team',
                        icon: 'fa fa-user',
                        select: {
                            circle: 'register-circle-disabled',
                            footer: 'register-footer-disabled',
                            selected: false,
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
                        agree: false,
                    },
                ],

                planSelected: '',

                term: '',

                title: '',

                id: '',

            }
        },

        methods: {
            showTerms(plan){
              this.term = plan.term,
              this.title = plan.name,
              this.id = plan.id,
              this.$refs.terms.show();
            },

            agreeText(){
             console.log('Agree');
            },
            selectedPlan(plan){
                plan.select = {
                    circle: 'register-circle',
                    footer: 'register-footer',
                    selected: true,
                };

                this.planSelected = plan.id;
                this.updatePlans(plan);
            },

            updatePlans(planUpdate){

                this.plans.forEach(plan => {
                    if (plan.name != planUpdate.name) {
                        plan.select = {
                            circle: 'register-circle-disabled',
                            footer: 'register-footer-disabled',
                            selected: false,
                        }
                        console.log('Plan name updated', plan.name);
                    }
                });
            }
        },


    }
</script>