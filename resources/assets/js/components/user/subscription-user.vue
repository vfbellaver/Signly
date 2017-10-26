<template>
    <div>
        <plan :stripe-id="user.stripe_id"></plan>
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

        }
    }
</script>