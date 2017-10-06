<template>
    <div>
        <p>child!</p>
    </div>
</template>
<style lang="scss" scoped="true">

</style>

<script>

    export default {

        props: {},


        data() {
            return {}
        },

        computed: {},

        watch: {},

        created(){
            console.log("Created Child");
            const self = this;
            setTimeout(function () {
                self.$emit('hello',{msg: 'Hello Parent'});
            },1000)
        },

        mounted(){
            console.log("Mounted Child");
        },

        methods: {}
    }

</script>