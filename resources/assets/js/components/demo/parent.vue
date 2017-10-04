<template>
    <div>
        <p>parent</p>
        <child></child>
    </div>
</template>
<style lang="scss" scoped="true">

</style>

<script>
    import Child from './child.vue';

    export default {

        props: {},

        components: {
            Child,
        },

        data() {
            return {}
        },

        computed: {},

        watch: {},

        created(){
            console.log("Created Parent");
        },

        mounted(){
            console.log("Mounted Parent");
        },

        methods: {}
    }

</script>