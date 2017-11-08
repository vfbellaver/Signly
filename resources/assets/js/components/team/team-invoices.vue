<template>
    <div>
      <ul>
          <li v-for="(invoice , index) in invoices"></li>
      </ul>
    </div>
</template>
<style lang="scss" scoped="scoped">

</style>
<script>

    import * as Slc from '../../vue/http'

    export default {

        data() {
            return {
                invoices: [],
            }
        },

        created(){
           this.getInvoices();
        },

        methods: {
            getInvoices(){
                Slc.get(laroute.route('api.payment.invoices')).then((response) => {
                    this.invoices = response;
                    console.log('Invoices ',response);
                });
            },

        }
    }
</script>