<template>
    <modal size="sm">
        <modal-header>Features</modal-header>

        <modal-body>
            <table class="table table-borderless m-b-none" v-cloak="true">
                <tbody v-if="features != null">
                    <tr><strong>Users</strong>{{" " + features.users}}</tr>
                    <tr><strong>Billboards</strong>{{" " + features.billboards}}</tr>
                    <tr><strong>Pdf's</strong>{{" " + features.pdfs}}</tr>
                    <tr><strong>Proposals</strong>{{" " + features.proposals}}</tr>
                    <tr><strong>Contracts</strong>{{" " + features.contracts}}</tr>
                    <tr><strong>Scheduler</strong>{{" " + features.scheduler}}</tr>
                    <tr><strong>White Label</strong>{{" " + features.whiteLabel}}</tr>
                    <tr><strong>Value Monthly</strong>{{" " + features.valueMonthly}}</tr>
                    <tr><strong>Value Annual</strong>{{" " + features.valueAnnual}}</tr>
                </tbody>
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
