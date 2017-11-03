<template>
    <modal size="sm">
        <modal-header>Features</modal-header>

        <modal-body>
            <table class="table table-borderless m-b-none" v-cloak="true">
                <ul v-if="features != null">
                    <li><strong>Users</strong>{{" " + features.users}}</li>
                    <li><strong>Billboards</strong>{{" " + features.billboards}}</li>
                    <li><strong>Pdf's</strong>{{" " + features.pdfs}}</li>
                    <li><strong>Proposals</strong>{{" " + features.proposals}}</li>
                    <li><strong>Contracts</strong>{{" " + features.contracts}}</li>
                    <li><strong>Scheduler</strong>{{" " + features.scheduler}}</li>
                    <li><strong>White Label</strong>{{" " + features.whiteLabel}}</li>
                    <li><strong>Value Monthly</strong>{{" " + features.valueMonthly}}</li>
                    <li><strong>Value Annual</strong>{{" " + features.valueAnnual}}</li>
                </ul>
            </table>
        </modal-body>
        <modal-footer>
            <a @click="ok" class="btn btn-success">OK</a>
        </modal-footer>

    </modal>
</template>
<style>
    .width{
        width: 50px;
    }
</style>
<script>

    import * as Slc from "../../vue/http";
    import ModalForm from '../shared/Mixins/ModalForm';

    export default {
        props: {
            features: {required:true}
        },

        data(){
            return{
                features: [{
                    users: 'a',
                    billboards: 's',
                    pdfs: 's',
                    proposals: 's',
                    contracts: 's',
                    scheduler: 's',
                    whiteLabel: '-',
                    valueMonthly: '299',
                    valueAnnual: '449',
                }]
            }
        },

        computed: {
            dateNow(){
                return moment().format('L');
            },

        },

        mixins: [ModalForm],

        components: {},

        data() {
            return {}
        },

        mounted(){

        },

        methods: {
            ok() {
                this.$emit('Step2', {plan: this.id});
                $(this.$el).modal('hide');
            },
        }
    }
</script>
