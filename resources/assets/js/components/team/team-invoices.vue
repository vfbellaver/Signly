<template>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Invoice List
                </h5>
            </div>
            <div class="ibox-content">
                <table class="footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded">
                    <thead>
                    <tr>
                        <th class="footable-visible footable-first-column footable-sortable">Company Name</th>
                        <th class="footable-visible footable-sortable">Plan<span class="footable-sort-indicator"></span>
                        </th>
                        <th class="footable-visible footable-sortable">Total</th>
                        <th class="footable-visible footable-sortable">Date<span class="footable-sort-indicator"></span>
                        </th>
                        <th class="footable-visible footable-last-column footable-sortable">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="footable-even" v-for="(invoice , index) in invoices">
                        <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                            {{user.team.name}}
                        </td>
                        <td class="footable-visible">
                            {{user.subscription[0].stripe_plan}}
                        </td>
                        <td class="footable-visible">
                            {{invoice.total}}
                        </td>
                        <td class="footable-visible">
                            {{invoice.date}}
                        </td>
                        <td class="footable-visible">
                            <button class="btn btn-primary btn-xs"
                            @click="generatePDF(invoice.id)"
                            >
                                <i class="fa fa-file-pdf-o"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped="scoped">
    .table {
        margin-top: 10px;
    }

    .ibox {
        clear: none;
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 0;
    }

    .ibox-content {
        clear: none;
    }
</style>
<script>

    import * as SLC from '../../vue/http'

    export default {

        data() {
            return {
                invoices: [],
                user: Slc.user
            }
        },

        created(){
            this.getInvoices();
        },

        methods: {

            getInvoices(){
                SLC.get(laroute.route('api.payment.invoices')).then((response) => {
                    this.invoices = response[0];
                    console.log('Invoices ', response[0]);
                });
            },

            generatePDF(id){
               window.location = laroute.route('payment.invoice.pdf',{invoice:id});
            },

        }
    }
</script>