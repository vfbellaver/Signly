<template>
    <div>
        <plan :stripe-id="user.stripe_id"></plan>
        <button class="btn btn-danger" @click="deleteSubscription">
           DELETE
        </button>
    </div>
</template>

<style>

</style>

<script>
    import _ from 'lodash';
    import * as Slc from "../../vue/http";

    export default {
        props: {
          user:{required:true}
        },
        components: {},

        data() {
            return {

            }
        },

        created() {

        },

        watch: {

        },

        methods: {
            deleteSubscription(){
                let self = this;
                Slc.get(laroute.route("api.payment.delete.card"))
                    .then(response => {
                        console.log('Subscription Deleted',response);
                    });
            }
        }
    }
</script>